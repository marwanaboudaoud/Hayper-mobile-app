<?php


namespace App\Src\Repositories\Hyper\Token;

use App\ActivateUserToken;
use App\Src\Mappers\Hyper\Token\ActivateUserTokenEloquentMapper;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\Token\ActivateUserTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Null_;

class ActivateUserTokenRepository implements ITokenRepository
{
    /**
     * @param  string $token
     * @return ActivateUserTokenModel
     */
    public function findByToken(string $token)
    {
        $activateUser = ActivateUserToken::where('token', $token)->first();

        if (!$activateUser) {
            return null;
        }
        return ActivateUserTokenEloquentMapper::toModel($activateUser);
    }

    /**
     * @param  UserModel $userModel
     * @return ActivateUserTokenModel
     */
    public function generate(UserModel $userModel)
    {
        $randomToken = Str::random(35);

        $tokenExist = $this->findByToken($randomToken);

        if ($tokenExist) {
            return $this->generate($userModel);
        }

        $token = new ActivateUserToken();
        $token->token = $randomToken;
        $token->user_id = $userModel->getId();
        $token->save();

        return ActivateUserTokenEloquentMapper::toModel($token);
    }

    /**
     * @param  string $token
     * @return ActivateUserTokenModel
     */
    public function used(string $token)
    {
        $activateUser = ActivateUserToken::where('token', $token)->first();

        if (!$activateUser) {
            return null;
        }

        $activateUser->is_used = true;
        $activateUser->save();

        return $this->findByToken($token);
    }
}
