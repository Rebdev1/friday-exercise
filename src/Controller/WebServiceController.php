<?php

namespace App\Controller;

use App\Form\LocationSearchType;
use App\Service\WebServiceEngine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebServiceController extends AbstractController
{
    #[Route('/web/service/ZWSLOC', name: 'app_web_service_ZWSLOC')]
    public function ZWSLOC(
        Request $request,
        WebServiceEngine $webServiceEngine
    ): Response {
        //define the web service that will be called on the button
        $webServiceName = 'ZWSLOC';
        $resultWebService = null; //define the request variable
        //display the form
        $form = $this->createform(LocationSearchType::class); //create the form of the Location
        $form->handleRequest($request);
        //TODO - (1) blind validation on the form using php to check isValid
        //       (2) database check -
        //       (3) service - cache for a long time to live to call web service to get the information

        if ($form->isSubmitted() && $form->isValid()) {
            $formResult = $form->getData();
            $I_LOC = $formResult['I_LOC'];
            $I_STOFCY = $formResult['I_STOFCY'];

            $webServiceRequestParam = [
                'PARAM_IN' => $formResult,
                // 'PARAM_IN' => [
                //     'I_STOFCY' => 'FR011',
                //     'I_LOC'    => ''
                // ]
            ];

            //Execute web service soap call
            $resultWebService = $webServiceEngine->run(
                $webServiceName,
                $webServiceRequestParam
            );

            // TODO : Extract data from the response

            //dd(
            // $form,
            // $form->getData(),
            // $formResult['I_LOC'],
            // ($form->getData())['I_STOFCY'],   //this is the same as the line above
            // $I_LOC,
            // $I_STOFCY,
            //    $resultWebService
            //);

            $form = null; //form dies to create an if
        }

        return $this->render(
            'transaction/' . $webServiceName . '/index.html.twig',
            [
                //starts in the templates folder
                'controller_name' => 'WebServiceController',
                'searchlocation_form' => !is_null($form)
                    ? $form->createView()
                    : null, //pass the whole form to twig
                'result_web_service' => $resultWebService, //pass the web service result
            ]
        );
    }

    #[Route('/web/service/ZWSSTOCK', name: 'app_web_service_ZWSSTOCK')]
    public function ZWSSTOCK(): Response
    {
        $webServiceName = 'ZWSSTOCK';
        $webServiceRequestParam = [
            'PARAM_IN' => [
                'I_STOFCY' => 'FR011',
                'I_ITMREF' => '',
                'I_LOT' => '',
                'I_LOC' => '',
            ],
        ];

        // TODO : Execute web service soap call

        // TODO : Extract data from the response

        return $this->render(
            'transaction/' . $webServiceName . '/index.html.twig',
            [
                'controller_name' => 'WebServiceController',
                // TODO : Pass data to Twig
            ]
        );
    }
}
