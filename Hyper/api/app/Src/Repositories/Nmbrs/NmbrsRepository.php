<?php


namespace App\Src\Repositories\Nmbrs;

use App\Exceptions\Nmbrs\NmbrsDefaultEnvNotSetException;
use SoapClient;
use SoapHeader;
use SoapVar;

class NmbrsRepository implements INmbrsRepository
{
    /**
     * @var SoapClient
     */
    protected $client;

    public function __construct(string $serviceEndpoint)
    {
        $this->initSoap($serviceEndpoint);
    }

    /**
     * @param  string $serviceEndpoint
     * @return SoapClient
     * @throws NmbrsDefaultEnvNotSetException
     * @throws \SoapFault
     */
    public function initSoap(string $serviceEndpoint)
    {
        $url = \env('NMBRS_BASE_URL_SOAP');
        $endpoint = \env('NMBRS_SOAP_API_ENDPOINT');

        if (!$url || !$endpoint) {
            throw new NmbrsDefaultEnvNotSetException();
        }

        $soapUrl = $url . '/' . $endpoint;
        $serviceUrl = $soapUrl . '/' . $serviceEndpoint;
        $wsdl = $serviceUrl . '.asmx?WSDL';
        $headerVar = new SoapVar(
            "<AuthHeader xmlns='$serviceUrl'>
                        <Username>marlijn@holygrow.nl</Username>
                        <Token>5720edd429b14b9b94f69a693525dad6</Token>
                    </AuthHeader>",
            XSD_ANYXML
        );
        $header = new SoapHeader($url, 'RequestParams', $headerVar);
        $client = new SoapClient($wsdl, ['trace' => 1]);
        $client->__setSoapHeaders($header);
        return $this->client = $client;
    }
}
