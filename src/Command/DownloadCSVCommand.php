<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZipArchive;

class DownloadCSVCommand extends Command
{
    protected static $defaultName = 'app:download-rates';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (file_put_contents("public/rates.zip", fopen("https://www.ecb.europa.eu/stats/eurofxref/eurofxref.zip", 'r'))) {
            $zip = new ZipArchive;
            if ($zip->open('public/rates.zip') === true) {
                $zip->extractTo('/public/rates/');
                $zip->close();
            }
            return Command::FAILURE;
        }

        return Command::FAILURE;
    }
}
