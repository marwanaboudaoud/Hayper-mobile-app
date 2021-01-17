<?php


namespace App\Src\Mappers\Request\Declaration;

use App\Http\Requests\Declaration\DeclarationUploadRequest;
use App\Src\Models\Hyper\Declaration\DeclarationModel;
use Carbon\Carbon;

class DeclarationUploadRequestMapper
{
    public static function toModel(DeclarationUploadRequest $declarationUploadRequest)
    {
        return (new DeclarationModel())
            ->setDeclarationType($declarationUploadRequest->declaration_type)
            ->setDateOfSubmission(new Carbon($declarationUploadRequest->date_of_submission))
            ->setLocation($declarationUploadRequest->location)
            ->setAmountExcVat($declarationUploadRequest->amount_exc_vat)
            ->setVat($declarationUploadRequest->vat)
            ->setImage($declarationUploadRequest)
            ->setToken($declarationUploadRequest->header('api-key'));
    }
}
//->file('image')
