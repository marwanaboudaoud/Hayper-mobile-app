<?php


namespace App\Src\Services\Hyper\Declaration;

use App\Src\Models\Hyper\Declaration\DeclarationModel;

interface IDeclarationUploadService
{
    /**
     * @param DeclarationModel $declarationModel
     * @return mixed
     */
    public function upload(DeclarationModel $declarationModel);
}
