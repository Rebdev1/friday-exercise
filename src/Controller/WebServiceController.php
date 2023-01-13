<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebServiceController extends AbstractController
{
    #[Route('/web/service/ZWSLOC', name: 'app_web_service_ZWSLOC')]
    public function ZWSLOC(): Response
    {
        // Extra step: override default I_STOFCY with query param if it does exist.

        $webServiceName         = 'ZWSLOC';
        $webServiceRequestParam = [
            'PARAM_IN' => [
                'I_STOFCY' => 'FR011',
                'I_LOC'    => ''
            ]
        ];

        // TODO : Execute web service soap call

        // TODO : Extract data from the response

        return $this->render('transaction/' . $webServiceName . '/index.html.twig', [
            'controller_name' => 'WebServiceController',
            // TODO : Pass data to Twig
        ]);
    }

    #[Route('/web/service/ZWSSTOCK', name: 'app_web_service_ZWSSTOCK')]
    public function ZWSSTOCK(): Response
    {
        $webServiceName         = 'ZWSSTOCK';
        $webServiceRequestParam = [
            "PARAM_IN" => [
                "I_STOFCY" => 'FR011',
                "I_ITMREF" => '',
                "I_LOT"    => '',
                "I_LOC"    => ''
            ]
        ];

        // TODO : Execute web service soap call

        // TODO : Extract data from the response

        return $this->render('transaction/' . $webServiceName . '/index.html.twig', [
            'controller_name' => 'WebServiceController',
            // TODO : Pass data to Twig
        ]);
    }
}
