<?php

namespace App\Http\Controllers\Document;

use App\Exceptions\DocumentType\DocumentTypeNotFoundException;
use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Exceptions\Nmbrs\NmbrsEmployeeNotFound;
use App\Http\Requests\Upload\DocumentRequest;
use App\Src\Services\Nmbrs\Upload\IDocumentNmbrsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    protected $documentNmbrsService;

    /**
     * UploadController constructor.
     * @param IDocumentNmbrsService $documentNmbrsService
     */
    public function __construct(IDocumentNmbrsService $documentNmbrsService)
    {
        $this->documentNmbrsService = $documentNmbrsService;
    }

    /**
     * @param DocumentRequest $documentRequest
     * @return JsonResponse
     */
    public function upload(DocumentRequest $documentRequest)
    {
        $documentModel = $documentRequest->map();
        try {
            $this->documentNmbrsService->upload($documentModel);

            return response()->json([
                'message' => 'Successfully uploaded to nmbrs!'
            ]);
        } catch (NmbrsEmployeeNotFound $employeeNotFound) {
            return response()->json([
                'message' => $employeeNotFound->getMessage()
            ], $employeeNotFound->getCode());
        } catch (EmployeeNotFoundException $employeeNotFoundException) {
            return response()->json([
                'message' => $employeeNotFoundException->getMessage()
            ], $employeeNotFoundException->getCode());
        } catch (DocumentTypeNotFoundException $documentTypeNotFoundException) {
            return response()->json([
                'message' => $documentTypeNotFoundException->getMessage()
            ], $documentTypeNotFoundException->getCode());
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
