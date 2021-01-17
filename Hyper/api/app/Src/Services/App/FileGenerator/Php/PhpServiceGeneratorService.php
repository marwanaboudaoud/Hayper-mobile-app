<?php


namespace App\Src\Services\App\FileGenerator\Php;

use Illuminate\Support\Str;

class PhpServiceGeneratorService extends PhpLayerGeneratorService
{
    /**
     * @var string
     */
    private $file;

    public function __construct(string $project, string $directory, string $fileName, ?string $action)
    {
        $this->file = $fileName;

        parent::__construct($project, $directory, $fileName . $action, 'Service');
    }

    public function generate()
    {
        $fileName = $this->getFileName();
        $interfaceFileName = 'I' . $fileName;
        $repoFileName = $this->file  . 'Repository';
        $repoInterfaceFileName = 'I' . $repoFileName;
        $repoVariableName = '$' . Str::camel($repoFileName);
        $repoPath = 'app/Src/Repositories/' . $this->getLayer() . '/' .
            $this->getDirectory() .'/' . $repoFileName . '.php';

        (new PhpInterfaceGeneratorService(
            'Services/' . $this->getLayer() . '/' . $this->getDirectory() .'/' . $interfaceFileName
        )
        )->generate();

        (new PhpClassGeneratorService(
            'Services/' . $this->getLayer() . '/' . $this->getDirectory() .'/' . $this->getFileName(),
            'php:service_class'
        )
        )   ->useFile($repoPath)
            ->construct($repoInterfaceFileName, $repoVariableName)
            ->implements($interfaceFileName)
            ->generate();
    }
}
