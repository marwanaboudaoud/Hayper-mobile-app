<?php


namespace App\Src\Services\Nmbrs\Upload;

use App\Src\Models\Nmbrs\DocumentModel;

interface IDocumentNmbrsService
{
    public function upload(DocumentModel $documentModel);
}
