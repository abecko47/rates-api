<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RatesController
{
    /**
     * @Route("/rates")
     */
    public function indexAction(): JsonResponse
    {

        if (file_exists('rates.json')) {
            $rates = file_get_contents('rates.json');
            return new JsonResponse(json_decode($rates));
        }

        $response = new JsonResponse(['error' => 'Rates are not available.']);
        $response->setStatusCode(500);

        return $response;
    }
}
