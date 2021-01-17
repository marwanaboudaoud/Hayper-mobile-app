<?php


namespace App\Src\Services\App\FileGenerator\Php;

class PhpMapGeneratorService extends PhpLayerGeneratorService
{
    public function __construct(string $project, string $directory, string $fileName)
    {
        parent::__construct($project, $directory, $fileName, 'Mapper');
    }

    public function generate()
    {
        
        (new PhpClassGeneratorService(
            'Mappers/' . $this->getLayer() . '/' . $this->getDirectory() .'/' . $this->getFileName()
        )
        )->generate();
    }
}
