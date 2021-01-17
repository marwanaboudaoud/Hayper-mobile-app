<?php

namespace App\Http\Middleware;

use App\Exceptions\Auth\UserNotActiveException;
use App\Exceptions\Auth\UserNotFoundException;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Auth\IAuthService;
use Carbon\Carbon;
use Closure;
use function Sentry\captureException;

class IsAuthenticated
{
    /**
     * @var IAuthService
     */
    protected $authService;

    public function __construct(IAuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('api-key');

        if (!$token) {
            return response()->json([
                'message' => 'Token not set!'
            ], 422);
        }

        try {
            $userModel = $this->authService->checkApiToken($token);
            $today = Carbon::today();
            $outOfService = $userModel->getOutOfService();

            if ($outOfService && $today > $outOfService->setTime(0, 0, 0)) {
                return response()->json([
                    'message' => 'User is out of service!'
                ], 409);
            }
        } catch (UserNotFoundException $exception) {
            return response()->json([
                'message' => 'User not found!'
            ], $exception->getCode());
        } catch (UserNotActiveException $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], $exception->getCode());
        } catch (\Exception $exception) {
            captureException($exception);

            return response()->json([
                'message' => 'Something went wrong!'
            ], 500);
        }

        return $next($request);
    }
}
