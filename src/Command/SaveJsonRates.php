<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SaveJsonRates extends Command
{
    protected static $defaultName = 'app:process-json';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fh = fopen('public/rates/eurofxref.csv', 'r');

        $csvData = [];

        while (($row = fgetcsv($fh, 0, ',')) !== false) {
            $csvData[] = $row;
        }

        $jsonData = [];
        $cols = count($csvData[0]) - 1;
        $jsonData['Date'] = $csvData[1][0];
        for ($i = 1; $i < $cols; $i++) {
            $jsonData[str_replace(" ", "", $csvData[0][$i])] = floatval($csvData[1][$i]);
        }

        file_put_contents('public/rates.json', json_encode($jsonData));
        return Command::SUCCESS;
    }
}
