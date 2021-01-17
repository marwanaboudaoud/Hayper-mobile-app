<?php

namespace App\Http\Controllers\Declaration;

use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Http\Requests\Declaration\DeclarationUploadRequest;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Declaration\DeclarationUploadService;
use App\Src\Services\Hyper\Declaration\IDeclarationUploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeclarationController extends Controller
{
    /**
     * @var IDeclarationUploadService
     */
    private $declarationUploadService;

    public function __construct(IDeclarationUploadService $declarationUploadService)
    {
        $this->declarationUploadService = $declarationUploadService;
    }


    /**
     * @param DeclarationUploadRequest $declarationUploadRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(DeclarationUploadRequest $declarationUploadRequest)
    {
        $declarationModel = $declarationUploadRequest->map();

        try {
            $this->declarationUploadService->upload($declarationModel);
            return JsonResponse::ok(['message' => 'Mail send successfully!']);
        } catch (EmployeeNotFoundException $employeeNotFoundException) {
            return JsonResponse::notOk($employeeNotFoundException->getMessage(), $employeeNotFoundException->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
