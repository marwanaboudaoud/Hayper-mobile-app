<?php


namespace App\Src\Services\App\FileGenerator;

use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\StreamOutput;

abstract class FileGeneratorService implements IFileGeneratorService
{
    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */
    private $type;

    /**
     * @var
     */
    private $args;

    public function __construct(string $fileName, string $type)
    {
        $this->setFileName($fileName);
        $this->setType($type);
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    private function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return FileGeneratorService
     */
    private function setType(string $type): FileGeneratorService
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * @param mixed $args
     * @return FileGeneratorService
     */
    public function setArgs(string $args): FileGeneratorService
    {
        $this->args = $args;

        return $this;
    }


    public function generate()
    {
        $command = 'generate '. $this->getType() .' '. $this->getFileName() . ' ' . $this->getArgs();
        $stream = fopen("php://output", "w");

        Artisan::call($command, [], new StreamOutput($stream));
        exec('php vendor/bin/phpcbf --standard=PSR2 app');
    }
}
