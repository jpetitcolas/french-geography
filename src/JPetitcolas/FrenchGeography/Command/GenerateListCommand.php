<?php

namespace JPetitcolas\FrenchGeography\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use JPetitcolas\FrenchGeography\Parser\Insee\InseeRegionParser;

use JPetitcolas\FrenchGeography\Formatter\Region\RegionYamlFormatter;

class GenerateListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('french-geography:generate')
            ->setDescription('Generate a list of regions, departments or cities based on specified parameters.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('Parsing <comment>%s</comment> file...', '/tmp/reg2012.txt'));

        $parser = new InseeRegionParser();
        $parser->setSource('/tmp/reg2012.txt');
        $regions = $parser->parse();

        $output->writeln(sprintf('File parsed. Found <info>%d regions</info>.', count($regions)));

        $output->writeln(sprintf('Generating output file in <comment>%s</comment> format.', 'YAML'));
        $formatter = new RegionYamlFormatter($regions);
        $formattedRegions = $formatter->format();
        file_put_contents('/tmp/output.yml', $formattedRegions);
        $output->writeln(sprintf('File successfully generated in: <info>%s</info>.', '/tmp/output.yml'));
    }
}
