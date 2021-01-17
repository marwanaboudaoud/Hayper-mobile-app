<?php


namespace App\Src\Services\App\FileGenerator\Php;

class PhpRepositoryGeneratorService extends PhpLayerGeneratorService
{
    public function __construct(string $project, string $directory, string $fileName)
    {
        parent::__construct($project, $directory, $fileName, 'Repository');
    }

    public function generate()
    {
        $interfaceFileName = 'I' . $this->getFileName();

        (new PhpInterfaceGeneratorService(
            'Repositories/' . $this->getLayer() . '/' . $this->getDirectory() .'/' . $interfaceFileName
        )
        )->generate();

        (new PhpClassGeneratorService(
            'Repositories/' . $this->getLayer() . '/' . $this->getDirectory() .'/' . $this->getFileName(),
            'php:repository_class'
        )
        )->implements($interfaceFileName)->generate();
    }
}
