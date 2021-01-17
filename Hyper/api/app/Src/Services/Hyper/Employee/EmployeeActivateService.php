<?php


namespace App\Src\Services\Hyper\Employee;

use App\Exceptions\Employee\ActivateTokenNotSetException;
use App\Src\Models\Hyper\Employee\EmployeeActivateModel;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Token\ITokenService;

class EmployeeActivateService implements IEmployeeActivateService
{
    /**
     * @var ITokenService
     */
    protected $activateUserService;

    /**
     * @var IUserRepository
     */
    protected $userRepository;

    public function __construct(ITokenService $activateUserService, IUserRepository $userRepository)
    {
        $this->activateUserService = $activateUserService;
        $this->userRepository = $userRepository;
    }

    /**
     * @param  EmployeeActivateModel $activateModel
     * @throws ActivateTokenNotSetException
     */
    public function activate(EmployeeActivateModel $activateModel)
    {
        $token = $activateModel->getToken();

        if (!$token) {
            throw new ActivateTokenNotSetException();
        }

        $model = $this->activateUserService->using($token);

        $this->userRepository->updatePassword($model->getUserId(), $activateModel->getPassword());
        $this->userRepository->updateActive($model->getUserId());
    }
}
