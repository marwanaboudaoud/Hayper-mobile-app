<?php


namespace App\Src\Services\Hyper\Score;

use App\Src\Models\Hyper\Score\ScoreModel;
use App\Src\Repositories\Hyper\Shift\IMyShiftRepository;
use App\Src\Services\Hyper\Auth\AuthService;
use App\Src\Services\Hyper\Auth\IAuthService;
use Whoops\Util\TemplateHelper;

class MyScoreService implements IMyScoreService
{
    /**
     * @var IAuthService
     */
    private $authService;

    /**
     * @var IMyShiftRepository
     */
    private $myShiftRepository;

    /**
     * MyScoreService constructor.
     * @param IAuthService $authService
     * @param IMyShiftRepository $myShiftRepository
     */
    public function __construct(IAuthService $authService, IMyShiftRepository $myShiftRepository)
    {
        $this->authService = $authService;
        $this->myShiftRepository = $myShiftRepository;
    }

    public function get()
    {
        $token = $this->authService->getToken();
        $shiftsCount = $this->myShiftRepository->count($token);

        $scoreModel = new ScoreModel();
        $scoreModel->setTotalShifts($shiftsCount);

        return $scoreModel;
    }
}
