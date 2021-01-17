<?php


namespace App\Src\Repositories\Nmbrs\Upload;

use App\Src\Models\Nmbrs\DocumentModel;

interface IUploadRepository
{
    public function upload(DocumentModel $documentModel);
}
