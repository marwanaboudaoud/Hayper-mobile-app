<?php


namespace App\Src\Services\Hyper\Friend;

use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Src\Models\Hyper\Friend\FriendModel;
use App\Src\Repositories\Hyper\Friend\IFriendMailRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Notify\IFriendSignUpNotifyService;

class FriendSignUpService implements IFriendSignUpService
{
    /**
     * @var IFriendSignUpNotifyService
     */
    private $friendSignUpNotifyService;

    /**
     * @var IUserRepository
     */
    private $userRepository;

    public function __construct(IFriendSignUpNotifyService $friendSignUpNotifyService, IUserRepository $userRepository)
    {
        $this->friendSignUpNotifyService = $friendSignUpNotifyService;
        $this->userRepository = $userRepository;
    }

    public function setFriendModel()
    {
    }

    /**
     * @param FriendModel $friendModel
     * @return mixed|void
     * @throws EmployeeNotFoundException
     */
    public function signUp(FriendModel $friendModel)
    {
        $foundUser = $this->userRepository->findByApiToken($friendModel->getToken());

        if (!$foundUser) {
            throw new EmployeeNotFoundException();
        }

        $friendModel->setUser($foundUser);
        $this->friendSignUpNotifyService->setFriendModel($friendModel);
        $this->friendSignUpNotifyService->send($foundUser);
    }
}
