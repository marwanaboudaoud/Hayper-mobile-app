<?php


namespace App\Src\Services\App\FileGenerator\Php;

use App\Src\Services\App\FileGenerator\IFileGeneratorService;

abstract class PhpLayerGeneratorService implements IFileGeneratorService
{
    /**
     * @var string
     */
    private $project;

    /**
     * @var string
     */
    private $directory;

    /**
     * @var string
     */
    private $fileName;

    public function __construct(string $project, string $directory, string $fileName, string $layer)
    {
        $this->setLayer($project);
        $this->setDirectory($directory);
        $this->setFileName($fileName, $layer);
    }

    /**
     * @return string
     */
    protected function getLayer(): string
    {
        return $this->project;
    }

    /**
     * @param string $project
     * @return PhpServiceGeneratorService
     */
    protected function setLayer(string $project): PhpLayerGeneratorService
    {
        $this->project = $project;
        return $this;
    }

    /**
     * @return string
     */
    protected function getDirectory(): string
    {
        return $this->directory;
    }

    /**
     * @param string $directory
     * @return PhpServiceGeneratorService
     */
    protected function setDirectory(string $directory): PhpLayerGeneratorService
    {
        $this->directory = $directory;
        return $this;
    }

    /**
     * @return string
     */
    protected function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @param string $layer
     * @return PhpLayerGeneratorService
     */
    protected function setFileName(string $fileName, string $layer): PhpLayerGeneratorService
    {
        $this->fileName = $fileName . $layer;
        return $this;
    }
}
