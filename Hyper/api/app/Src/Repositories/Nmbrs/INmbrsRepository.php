<?php


namespace App\Src\Repositories\Nmbrs;

use App\Exceptions\Nmbrs\NmbrsDefaultEnvNotSetException;
use SoapClient;
use SoapHeader;
use SoapVar;

interface INmbrsRepository
{
    public function initSoap(string $serviceEndpoint);
}
