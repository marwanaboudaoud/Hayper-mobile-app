<?php


namespace App\Src\Repositories\Hyper\Token;

use App\ForgotPasswordToken;
use App\Src\Mappers\Hyper\Auth\PasswordTokenEloquentModelMapper;
use App\Src\Models\Hyper\Auth\ForgotPasswordModel;
use App\Src\Models\Hyper\Auth\ResetPasswordTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Token\ITokenRepository;
use Illuminate\Support\Str;

class ResetPasswordTokenRepository implements ITokenRepository
{
    /**
     * @param  UserModel $userModel
     * @return ResetPasswordTokenModel
     */
    public function generate(UserModel $userModel)
    {
        $randomToken = Str::random(50);

        $tokenExist = $this->findByToken($randomToken);

        if ($tokenExist) {
            return $this->generate($userModel);
        }

        $forgotPassword = new ForgotPasswordToken();
        $forgotPassword->token = $randomToken;
        $forgotPassword->user_id = $userModel->getId();
        $forgotPassword->save();

        return PasswordTokenEloquentModelMapper::toModel($forgotPassword);
    }

    /**
     * @param  string $token
     * @return ResetPasswordTokenModel
     */
    public function findByToken(string $token)
    {
        $forgotPassword = ForgotPasswordToken::where('token', $token)->first();

        if (!$forgotPassword) {
            return null;
        }

        return PasswordTokenEloquentModelMapper::toModel($forgotPassword);
    }

    /**
     * @param  string $token
     * @return ResetPasswordTokenModel|null
     */
    public function used(string $token)
    {
        $tokenModel = $this->findByToken($token);

        if (!$tokenModel) {
            return null;
        }

        ForgotPasswordToken::where(
            [
            'token' => $tokenModel->getToken()
            ]
        )->update(
            [
                'is_used' => 1
                ]
        );

        return $this->findByToken($token);
    }
}
