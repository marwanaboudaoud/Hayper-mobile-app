<?php


namespace App\Src\Repositories\Hyper\DocumentType;

use App\DocumentType;
use App\Src\Mappers\Hyper\DocumentType\DocumentTypeEloquentMapper;

class DocumentTypeRepository implements IDocumentTypeRepository
{
    /**
     * @param string $name
     * @return \App\Src\Models\Hyper\DocumentType\DocumentTypeModel|mixed
     */
    public function findByName(string $name)
    {
        $documentType = DocumentType::where('name', $name)->first();

        return DocumentTypeEloquentMapper::toModel($documentType);
    }
}
