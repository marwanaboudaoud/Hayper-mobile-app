<?php


namespace App\Src\Repositories\Hyper\User;

use App\Src\Mappers\Hyper\User\UserEloquentMapper;
use App\Src\Mappers\Hyper\User\UserModelMapper;
use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\Pagination\PaginationEmployeeModel;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\User\UserModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository implements IUserRepository
{

    /**
     * @param string $attr
     * @param string $arg
     * @param bool $eloquentModel
     * @return UserModel
     */
    public function findBy(string $attr, string $arg, bool $eloquentModel = false)
    {
        $user = User::select(
            DB::raw("users.*, (SELECT hw.amount FROM hourly_wages hw WHERE hw.role_id = users.role_id
                ORDER BY abs(age - TIMESTAMPDIFF(YEAR, users.date_of_birth, CURDATE())) LIMIT 1) AS hourly_wage")
        )->with(['contracts' => function ($q) {
            $q->with('user')->orderBy('created_at', 'desc')->limit(1);
        }])->where($attr, $arg)->first();

        if (!$user) {
            return null;
        }

        if ($eloquentModel) {
            return $user;
        }

        return UserEloquentMapper::toUserModel($user);
    }

    /**
     * @param int $id
     * @param bool $eloquentModel
     * @return UserModel
     */
    public function findById($id, bool $eloquentModel = false)
    {
        return $this->findBy('id', $id, $eloquentModel);
    }

    /**
     * @param  $email
     * @return UserModel
     */
    public function findByEmail(string $email)
    {
        return $this->findBy('email', $email);
    }

    /**
     * @param string $token
     * @return UserModel
     */
    public function findByApiToken(string $token)
    {
        return $this->findBy('api_token', $token);
    }

    /**
     * @param int $id
     * @return ApiTokenModel
     */
    public function generateToken(int $id)
    {
        $eloquentModel = User::find($id);
        $eloquentModel->api_token = hash('sha256', Str::random(40));
        $eloquentModel->save();

        return UserEloquentMapper::toApiTokenModel($eloquentModel);
    }

    /**
     * @param UserModel $userModel
     * @return UserModel
     */
    public function store(UserModel $userModel)
    {
        $user = UserModelMapper::toEloquentModel($userModel);
        $user->save();
        $user->worksOnProject()->sync($userModel->getWorkOnProject()->toArray());

        return UserEloquentMapper::toUserModel($user);
    }

    /**
     * @param int $id
     * @param UserModel $userModel
     * @return mixed|void
     */
    public function update(int $id, UserModel $userModel)
    {
        $foundUser = $this->findById($id);

        $updateModel = UserModelMapper::toEloquentUpdateModel($foundUser, $userModel);
        $updateModel->exists = true;
        $updateModel->save();

        return UserEloquentMapper::toUserModel($updateModel);
    }

    /**
     * @param PaginationEmployeeModel $paginationEmployeeModel
     * @return mixed
     */
    public function get(PaginationEmployeeModel $paginationEmployeeModel)
    {
        $users = User::query()
            ->selectRaw('users.*, roles.title AS role_title')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->with([
                'addresses',
                'emergencyContacts'
            ])
            ->tap(function ($collection) use ($paginationEmployeeModel) {
                $paginationEmployeeModel->setTotalItems($collection->count());
            })
            ->limit($paginationEmployeeModel->getLimit())
            ->offset(
                $paginationEmployeeModel->getLimit() * ($paginationEmployeeModel->getPage() - 1)
            )
            ->orderBy($paginationEmployeeModel->getOrderBy(), $paginationEmployeeModel->getDirection());

        if ($paginationEmployeeModel->getEmployee()) {
            $users->search($paginationEmployeeModel);
        }

        $users = $users->get();

        $models = UserEloquentMapper::toCollectionUserModel($users);
        return $paginationEmployeeModel->setItems($models);
    }

    /**
     * @param int $userId
     * @param string $unHashedPassword
     * @return UserModel
     */
    public function updatePassword(int $userId, string $unHashedPassword)
    {
        $eloquentModel = User::find($userId);
        $eloquentModel->password = Hash::make($unHashedPassword);
        $eloquentModel->save();

        return UserEloquentMapper::toUserModel($eloquentModel);
    }

    /**
     * @param int $userId
     * @param bool $isActive
     * @return mixed
     */
    public function updateActive(int $userId, bool $isActive = true)
    {
        $eloquentModel = User::find($userId);
        $eloquentModel->is_active = $isActive;
        $eloquentModel->save();

        return UserEloquentMapper::toUserModel($eloquentModel);
    }

    /**
     * @param PaginationEmployeeModel $paginationEmployeeModel
     * @return string|string[]
     */
    protected function getOrderColumn(PaginationEmployeeModel $paginationEmployeeModel)
    {
        if (strpos($paginationEmployeeModel->getOrderBy(), "roles.") !== false) {
            return str_replace("roles.", '', $paginationEmployeeModel->getOrderBy());
        }
        if (strpos($paginationEmployeeModel->getOrderBy(), "addresses.") !== false) {
            return str_replace("addresses.", '', $paginationEmployeeModel->getOrderBy());
        }

        if (strpos($paginationEmployeeModel->getOrderBy(), "role_title") !== false) {
            return 'title';
        }

        if (strpos($paginationEmployeeModel->getOrderBy(), "emergency_contacts.") !== false) {
            return str_replace(
                "emergency_contacts.",
                '',
                $paginationEmployeeModel->getOrderBy()
            );
        }
    }
}
