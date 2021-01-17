<?php


namespace App\Src\Repositories\Hyper\DocumentType;

interface IDocumentTypeRepository
{
    /**
     * @param string $name
     * @return mixed
     */
    public function findByName(string $name);
}
