<?php


namespace App\Src\Mappers\Hyper\DocumentType;

use App\DocumentType;
use App\Src\Models\Hyper\DocumentType\DocumentTypeModel;

class DocumentTypeEloquentMapper
{

    /**
     * @param DocumentType $documentType
     * @return DocumentTypeModel
     */
    public static function toModel(DocumentType $documentType)
    {
        return (new DocumentTypeModel())
            ->setId($documentType->id)
            ->setName($documentType->name)
            ->setDocumentType($documentType->document_guid_type);
    }
}
