<?php


namespace App\Src\Services\App\FileGenerator\Php;

use App\Src\Services\App\FileGenerator\FileGeneratorService;

class PhpClassGeneratorService extends FileGeneratorService
{
    public function __construct(string $fileName, $type = null)
    {
        parent::__construct($fileName, $type ?? 'php:class');
    }

    /**
     * @param string $interface
     * @return $this
     */
    public function implements(string $interface)
    {
        $this->args('implements', $interface);

        return $this;
    }

    /**
     * @param string $construct
     * @param string $constructVar
     * @return $this
     */
    public function construct(string $construct, string $constructVar)
    {
        $this->args('constructor', $construct);
        $this->args('constructorVar', $constructVar);

        return $this;
    }

    /**
     * @param string $fileName
     * @return $this
     */
    public function useFile(string $fileName)
    {
        $this->args('uses', $fileName);

        return $this;
    }

    /**
     * @param string $flag
     * @param string $arg
     */
    public function args(string $flag, string $arg)
    {
        $args = $this->getArgs() . ' --' . $flag . ' ' .$arg;

        $this->setArgs($args);
    }
}
