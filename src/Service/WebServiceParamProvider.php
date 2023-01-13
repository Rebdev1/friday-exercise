<?php

namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class WebServiceParamProvider
{
    private ContainerBagInterface $containerBag;
    private Collection $x3SoapParams;

    public function __construct(ContainerBagInterface $containerBag)
    {
        $this->containerBag = $containerBag;
        $this->x3SoapParams = new ArrayCollection();

        // TODO : Improve this by using application parameter, and a dedicated configuration file.

        $this->x3SoapParams->set('hostname', 'http://137.135.86.72:8124');
        $this->x3SoapParams->set('wsdlEndpoint', '/soap-wsdl/syracuse/collaboration/syracuse/CAdxWebServiceXmlCC?wsdl');

        $this->x3SoapParams->set('username', 'WSERV');
        $this->x3SoapParams->set('password', 'rDWtd\tY3=Jey/hFbjpW');

        $this->x3SoapParams->set('lang', 'ENG');
        $this->x3SoapParams->set('pool', 'SEEDSCAN');
        $this->x3SoapParams->set('config', 'adxwss.optreturn=JSON&adxwss.beautify=true');
    }

    /**
     * @return ArrayCollection|Collection Return the gathered parameter for SOAP request to X3.
     */
    public function getX3SoapParams(): ArrayCollection|Collection
    {
        return $this->x3SoapParams;
    }

    /**
     * @return string Return the endpoint of X3's WSDL.
     */
    public function getWsdlEndpoint(): string
    {
        return $this->x3SoapParams->get('hostname') . $this->x3SoapParams->get('wsdlEndpoint');
    }

    /**
     * @return array Return minimal configuration for a SOAP request to X3.
     */
    public function getCallContext(): array
    {
        return [
            'codeLang'      => $this->x3SoapParams->get('lang'),
            'poolAlias'     => $this->x3SoapParams->get('pool'),
            'requestConfig' => $this->x3SoapParams->get('config'),
        ];
    }
}