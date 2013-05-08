<?php

namespace JPetitcolas\FrenchGeography\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use JPetitcolas\FrenchGeography\Parser\Insee\InseeRegionParser;

use JPetitcolas\FrenchGeography\Formatter\Region\RegionYamlFormatter;

class GenerateListCommand extends Command
{
    protected static $availableTypes = array('region', 'department', 'city');
    protected static $availableFormats = array('yaml', 'sql');
    protected static $availableSourceFormats = array('insee');

    protected function configure()
    {
        $this
            ->setName('french-geography:generate')
            ->setDescription('Generate a list of regions, departments or cities based on specified parameters.')
            ->addArgument('type', InputArgument::REQUIRED, 'Which kind of data do you want to parse? [region, department, city]')
            ->addArgument('format', InputArgument::REQUIRED, 'In which format do you want to format input file? [yaml]')
            ->addArgument('sourceFormat', InputArgument::REQUIRED, 'Where did you take the specified source? [insee]')
            ->addArgument('source', InputArgument::REQUIRED, 'Source file containing data to parse.')
            ->addArgument('output', InputArgument::REQUIRED, 'Where do you want to store the formatted output file?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** Check arguments **/

        try {
            $this->checkArguments($input->getArguments());
        } catch (\Exception $e) {
            $output->writeln(sprintf('<error>Error: %s</error>', $e->getMessage()));
            return;
        }

        /** Parsing **/

        $output->writeln(sprintf('Parsing <comment>%s</comment> file...', $input->getArgument('source')));

        $parserClass  = 'JPetitcolas\\FrenchGeography\\Parser\\'.ucfirst($input->getArgument('sourceFormat')).'\\';
        $parserClass .= ucfirst($input->getArgument('sourceFormat')).ucfirst($input->getArgument('type')).'Parser';

        $parser = new $parserClass();
        $parser->setSource($input->getArgument('source'));
        $parsedItems = $parser->parse();

        $output->writeln(sprintf('File parsed. Found <info>%d items</info>.', count($parsedItems)));

        /** Formatting **/

        $output->writeln(sprintf('Generating output file in <comment>%s</comment> format.', 'YAML'));

        $formatterClassName  = 'JPetitcolas\\FrenchGeography\\Formatter\\'.ucfirst($input->getArgument('type')).'\\';
        $formatterClassName .= ucfirst($input->getArgument('type')).ucfirst($input->getArgument('format')).'Formatter';

        $formatter = new $formatterClassName($parsedItems);
        $formattedOutput = $formatter->format();

        /** Saving into output file **/

        file_put_contents($input->getArgument('output'), $formattedOutput);
        $output->writeln(sprintf('File successfully generated in: <info>%s</info>.', $input->getArgument('output')));
    }

    protected function checkArguments($arguments)
    {
        if (!in_array($arguments['type'], self::$availableTypes)) {
            throw new \Exception(sprintf('Specified type is not handled: %s.', $arguments['type']));
        }

        if (!in_array($arguments['format'], self::$availableFormats)) {
            throw new \Exception(sprintf('Specified format is not handled: %s.', $arguments['format']));
        }

        if (!in_array($arguments['sourceFormat'], self::$availableSourceFormats)) {
            throw new \Exception(sprintf('Specified sourceFormat is not handled: %s.', $arguments['sourceFormat']));
        }
    }
}
