<?php

namespace App\Http\Middleware;

use App\Src\Constants\RoleConstant;
use App\Src\Models\Hyper\Role\RoleModel;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Auth\IAuthService;
use Closure;

class IsAdmin
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

        $isAdmin = $this->authService->checkRole($token, [
            RoleConstant::ADMIN
        ]);

        if (!$isAdmin) {
            return JsonResponse::notOk('Forbidden', 403);
        }

        return $next($request);
    }
}
