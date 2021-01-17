<?php


namespace App\Src\Repositories\Hyper\User;

use App\Src\Models\Hyper\Auth\ApiTokenModel;
use App\Src\Models\Hyper\Pagination\PaginationEmployeeModel;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\User\UserModel;
use App\User;
use Illuminate\Http\Request;

interface IUserRepository
{
    /**
     * @param  string $attr
     * @param  string $arg
     * @param  bool   $eloquentModel
     * @return UserModel
     */
    public function findBy(string $attr, string $arg, bool $eloquentModel = false);

    /**
     * @param  int $id
     * @return UserModel
     */
    public function findById($id);


    /**
     * @param  $email
     * @return UserModel
     */
    public function findByEmail(string $email);

    /**
     * @param  string $token
     * @return UserModel
     */
    public function findByApiToken(string $token);

    /**
     * @param  int $id
     * @return ApiTokenModel
     */
    public function generateToken(int $id);

    /**
     * @param  UserModel $userModel
     * @return UserModel
     */
    public function store(UserModel $userModel);

    /**
     * @param  int       $id
     * @param  UserModel $userModel
     * @return mixed
     */
    public function update(int $id, UserModel $userModel);

    /**
     * @param PaginationEmployeeModel $paginationEmployeeModel
     * @return mixed
     */
    public function get(PaginationEmployeeModel $paginationEmployeeModel);

    /**
     * @param  int    $userId
     * @param  string $unHashedPassword
     * @return UserModel
     */
    public function updatePassword(int $userId, string $unHashedPassword);

    public function updateActive(int $userId, bool $isActive = true);
}
