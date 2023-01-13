<?php

namespace App\Service;

use Error;
use SoapClient;
use SoapFault;

class WebServiceEngine
{

    private WebServiceParamProvider $webServiceParamProvider;

    public function __construct(WebServiceParamProvider $webServiceParamProvider)
    {
        $this->webServiceParamProvider = $webServiceParamProvider;
    }

    /**
     * @param string $webServiceName    Web service name as defined in X3.
     * @param array  $parameters        Web service parameter, for more information refer to PostMan collection.
     *
     * @return array
     * @throws SoapFault
     * @throws Error
     */
    public function run(string $webServiceName, array $parameters): array
    {
        $wsdlEndpoint = $this->webServiceParamProvider->getWsdlEndpoint();
        $soapClientOptions = [
            'login'    => $this->webServiceParamProvider->getX3SoapParams()->get('username'),
            'password' => $this->webServiceParamProvider->getX3SoapParams()->get('password'),
        ];

        $soapClient = new SoapClient(
            $wsdlEndpoint,
            $soapClientOptions
        );

        $callContext = $this->webServiceParamProvider->getCallContext();

        $result = $soapClient->__soapCall(
            'run',
            [
                $callContext,
                $webServiceName,
                json_encode($parameters)
            ]
        );

        if (is_null($result->resultXml)) {
            dump($result);
            throw new Error($result->messages[0]->message);
        }

        return json_decode($result->resultXml, true);
    }
}