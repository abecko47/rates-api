<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class RatesController
{
    /**
     * @Route("/rates/")
     */
    public function indexAction(): JsonResponse
    {
        return new JsonResponse(['data' => 123]);
    }
}
