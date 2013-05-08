<?php

namespace JPetitcolas\FrenchGeography\Parser\Insee;

use JPetitcolas\FrenchGeography\Parser\Parser;
use JPetitcolas\FrenchGeography\Parser\ParserInterface;

use JPetitcolas\FrenchGeography\Entity\Region;

class InseeRegionParser extends Parser implements ParserInterface
{
    public function parse()
    {
        if (!$this->sourcePath) {
            throw new \Exception('Try to parse with no file set.');
        }

        $firstLine = true;
        $regions = array();

        $source = fopen($this->sourcePath, 'r');
        while ($line = fgetcsv($source, 0, "\t")) {
            // Skip headers
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $region = new Region();
            $region->setId($line[0]);
            $region->setName(utf8_encode($line[4]));

            $regions[] = $region;
        }
        fclose($source);

        return $regions;
    }
}
