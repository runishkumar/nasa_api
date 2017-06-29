<?php

namespace NasaApiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class NasaFetchNeosCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('nasa:fetch-neos')
            ->setDescription('Fetch NEOs data from nasa api.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $nasaApiService = $this->getContainer()->get('nasa.api.service');

        $nasaApiService->importFeedData();

        $output->writeln('Command result.');
    }
}
