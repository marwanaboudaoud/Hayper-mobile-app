<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\Auth\ResetPasswordTokenAlreadyUsedException;
use App\Exceptions\Auth\ResetPasswordTokenNotFoundException;
use App\Exceptions\Auth\UserInvalidPasswordException;
use App\Exceptions\Auth\UserNotActiveException;
use App\Exceptions\Auth\UserNotFoundException;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Src\Mappers\Hyper\Auth\ApiTokenModelMapper;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Repositories\Hyper\User\UserRepository;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Auth\IAuthService;
use App\Src\Services\Hyper\Notify\Mailable\AuthForgotPasswordMailNotifyService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * @var IAuthService
     */
    private $authService;

    public function __construct(IAuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $loginModel = $request->map();

        try {
            $token = $this->authService->login($loginModel);

            $mappedToken = ApiTokenModelMapper::toArray($token);

            return JsonResponse::ok($mappedToken);
        } catch (UserNotFoundException $exp) {
            return JsonResponse::notOk($exp->getMessage(), $exp->getCode());
        } catch (UserInvalidPasswordException $exp) {
            return JsonResponse::notOk($exp->getMessage(), $exp->getCode());
        } catch (UserNotActiveException $exp) {
            return JsonResponse::notOk($exp->getMessage(), $exp->getCode());
        } catch (\Exception $exp) {
            return JsonResponse::notOkException($exp);
        }
    }

    /**
     * @param ForgotPasswordRequest $request
     * @param AuthForgotPasswordMailNotifyService $forgotPasswordNotifyService
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(
        ForgotPasswordRequest $request,
        AuthForgotPasswordMailNotifyService $forgotPasswordNotifyService
    ) {
        $forgotPasswordModel = $request->map();

        try {
            $this->authService->forgotPassword($forgotPasswordModel, $forgotPasswordNotifyService);

            return JsonResponse::ok(['message' => 'Send forgot password message']);
        } catch (UserNotFoundException $exp) {
            return JsonResponse::notOk($exp->getMessage(), $exp->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param ResetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $resetPasswordModel = $request->map();

        try {
            $this->authService->resetPassword($resetPasswordModel);

            return JsonResponse::ok([], 204);
        } catch (ResetPasswordTokenNotFoundException $exp) {
            return JsonResponse::notOk($exp->getMessage(), $exp->getCode());
        } catch (ResetPasswordTokenAlreadyUsedException $exp) {
            return JsonResponse::notOk($exp->getMessage(), $exp->getCode());
        } catch (\Exception $exp) {
            return JsonResponse::notOkException($exp);
        }
    }
}
