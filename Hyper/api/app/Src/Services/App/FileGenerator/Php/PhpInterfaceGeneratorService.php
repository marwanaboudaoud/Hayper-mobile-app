<?php


namespace App\Src\Services\App\FileGenerator\Php;

use App\Src\Services\App\FileGenerator\FileGeneratorService;

class PhpInterfaceGeneratorService extends FileGeneratorService
{
    public function __construct(string $fileName)
    {
        parent::__construct($fileName, 'php:interface');
    }
}
