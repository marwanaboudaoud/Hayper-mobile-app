<?php

namespace App\Http\Controllers\Friend;

use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Http\Requests\Friend\SignUpAFriendRequest;
use App\Src\Services\Hyper\Friend\IFriendSignUpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyFriendsController extends Controller
{
    /**
     * @var IFriendSignUpService
     */
    private $friendSignUpService;

    public function __construct(IFriendSignUpService $friendSignUpService)
    {
        $this->friendSignUpService = $friendSignUpService;
    }

    /**
     * @param SignUpAFriendRequest $signUpAFriendRequest
     * @return JsonResponse
     */
    public function signUp(SignUpAFriendRequest $signUpAFriendRequest)
    {
        $friendModel = $signUpAFriendRequest->map();

        try {
            $this->friendSignUpService->signUp($friendModel);
            return response()->json([
                'message' => 'Your friend has been signed up successfully'
            ], 200);
        } catch (EmployeeNotFoundException $employeeNotFoundException) {
            return response()->json([
                'message' => $employeeNotFoundException->getMessage()
            ], $employeeNotFoundException->getCode());
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
