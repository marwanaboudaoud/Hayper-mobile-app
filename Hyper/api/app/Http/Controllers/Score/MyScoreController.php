<?php

namespace App\Http\Controllers\Score;

use App\Src\Mappers\Hyper\Score\ScoreModelMapper;
use App\Src\Services\Hyper\Score\IMyScoreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyScoreController extends Controller
{
    /**
     * @var IMyScoreService
     */
    private $myScoreService;

    /**
     * MyScoreController constructor.
     * @param IMyScoreService $myScoreService
     */
    public function __construct(IMyScoreService $myScoreService)
    {
        $this->myScoreService = $myScoreService;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        try {
            return response()->json([
                'results' => ScoreModelMapper::toArray($this->myScoreService->get())
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something went wrong!'
            ], 500);
        }
    }
}
