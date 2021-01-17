<?php


namespace App\Src\Repositories\Nmbrs\Upload;

use App\Src\Models\Nmbrs\DocumentModel;
use App\Src\Repositories\Nmbrs\NmbrsRepository;

class UploadRepository extends NmbrsRepository implements IUploadRepository
{
    public function __construct()
    {
        parent::__construct('EmployeeService');
    }

    public function upload(DocumentModel $documentModel)
    {
        $this->client->EmployeeDocument_UploadDocument([
            'EmployeeId' => $documentModel->getEmployeeId(),
            'StrDocumentName' => $documentModel->getDocumentName(),
            'Body' => $documentModel->getBody(),
            'GuidDocumentType' => $documentModel->getGuid()
        ]);

        return null;
    }
}
