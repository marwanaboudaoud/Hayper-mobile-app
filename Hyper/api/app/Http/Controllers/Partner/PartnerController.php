<?php

namespace App\Http\Controllers\Partner;

use App\Exceptions\Partner\PartnerNotFoundException;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Http\Requests\Pagination\PartnerPaginationRequest;
use App\Http\Requests\Partner\PartnerStoreRequest;
use App\Http\Requests\Partner\PartnerUpdateRequest;
use App\Src\Mappers\Hyper\Pagination\PaginationModelMapper;
use App\Src\Mappers\Hyper\Pagination\PaginationPartnerModelMapper;
use App\Src\Mappers\Hyper\Pagination\PaginationUserModelMapper;
use App\Src\Mappers\Hyper\Partner\PartnerCollectionMapper;
use App\Src\Mappers\Hyper\Partner\PartnerModelMapper;
use App\Src\Services\Hyper\Partner\IPartnerService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class PartnerController extends Controller
{
    /**
     * @var IPartnerService
     */
    protected $partnerService;

    public function __construct(IPartnerService $partnerService)
    {
        $this->partnerService = $partnerService;
    }

    /**
     * @param PartnerPaginationRequest $partnerPaginationRequest
     * @return JsonResponse
     */
    public function index(PartnerPaginationRequest $partnerPaginationRequest)
    {
        $partnerModel = $partnerPaginationRequest->map();

        try {
            return response()->json(
                PaginationModelMapper::toArray(
                    $this->partnerService->get($partnerModel),
                    (new PaginationPartnerModelMapper())
                ),
                200
            );
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * @param PartnerStoreRequest $partnerStoreRequest
     * @return JsonResponse
     */
    public function store(PartnerStoreRequest $partnerStoreRequest)
    {
        $partnerModel = $partnerStoreRequest->map();

        try {
            $this->partnerService->store($partnerModel);

            return response()->json([
                'message' => 'Partner registered successfully!'
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something went wrong'
            ], $exception->getCode());
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function find($id)
    {
        try {
            $partnerModel = $this->partnerService->find($id);
            return response()->json(
                [
                    'partner' => PartnerModelMapper::toArray($partnerModel)
                ],
                200
            );
        } catch (PartnerNotFoundException $notFoundException) {
            return response()->json([
                'message' => $notFoundException->getMessage()
            ], $notFoundException->getCode());
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something went wrong!'
            ], 500);
        }
    }


    /**
     * @param $id
     * @param PartnerUpdateRequest $partnerUpdateRequest
     * @return JsonResponse
     */
    public function update($id, PartnerUpdateRequest $partnerUpdateRequest)
    {
        $partnerModel = $partnerUpdateRequest->map();
        try {
            $partner = $this->partnerService->update($id, $partnerModel);
            $updatedPartner = PartnerModelMapper::toArray($partner);
            return response()->json(
                [
                    'message' => 'Partner updated successfully!',
                    'data' => $updatedPartner
                ],
                200
            );
        } catch (PartnerNotFoundException $exception) {
            return response()->json(
                [
                    'message' => $exception->getMessage()
                ],
                $exception->getCode()
            );
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something went wrong!'
            ], 500);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            $this->partnerService->delete($id);
            return response()->json(
                [
                    'Partner removed successfully!'
                ],
                200
            );
        } catch (PartnerNotFoundException $exception) {
            return response()->json(
                [
                    'message' => $exception->getMessage()
                ],
                $exception->getCode()
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'message' => $exception->getMessage()
                ],
                500
            );
        }
    }
}
