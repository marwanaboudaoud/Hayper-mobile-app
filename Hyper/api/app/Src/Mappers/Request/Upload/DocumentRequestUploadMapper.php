<?php


namespace App\Src\Mappers\Request\Upload;

use App\Http\Requests\Upload\DocumentRequest;
use App\Src\Models\Nmbrs\DocumentModel;

class DocumentRequestUploadMapper
{
    /**
     * @param DocumentRequest $documentRequest
     * @return DocumentModel
     */
    public static function toDocumentModel(DocumentRequest $documentRequest)
    {
        return (new DocumentModel())
            ->setUserId($documentRequest->user_id)
            ->setDocumentName(
                $documentRequest->file('body')->getClientOriginalName()
            )
            ->setBody(file_get_contents($documentRequest->file('body')))
            ->setGuid(null)
            ->setDocumentType($documentRequest->document_type);
    }
}
