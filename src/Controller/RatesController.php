<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RatesController
{
    /**
     * @Route("/rates/")
     */
    public function indexAction(): JsonResponse
    {
        $fh = fopen("eurofxref.csv", "r");

        $csvData = array();

        while (($row = fgetcsv($fh, 0, ",")) !== FALSE) {
            $csvData[] = $row;
        }

        $jsonData = [];
        $cols = count($csvData[0]) - 1;
        $jsonData['Date'] = $csvData[1][0];
        for ($i = 1; $i < $cols; $i++) {
            $jsonData[str_replace(" ", "", $csvData[0][$i])] = floatval($csvData[1][$i]);
        }

        return new JsonResponse($jsonData);
    }
}
