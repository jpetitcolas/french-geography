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

        $regions = array();
        $source = fopen($this->sourcePath, 'r');
        while ($line = fgetcsv($source, 0, "\t")) {
            $region = new Region();
            $region->setId($line[0]);
            $region->setName($line[4]);

            $regions[] = $region;
        }

        return $regions;
    }
}
