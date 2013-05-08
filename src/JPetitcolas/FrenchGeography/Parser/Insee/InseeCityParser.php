<?php

namespace JPetitcolas\FrenchGeography\Parser\Insee;

use JPetitcolas\FrenchGeography\Parser\Parser;
use JPetitcolas\FrenchGeography\Parser\ParserInterface;

use JPetitcolas\FrenchGeography\Entity\City;

class InseeCityParser extends Parser implements ParserInterface
{
    public function parse()
    {
        if (!$this->sourcePath) {
            throw new \Exception('Try to parse with no file set.');
        }

        $firstLine = true;
        $cities = array();

        $source = fopen($this->sourcePath, 'r');
        while ($line = fgetcsv($source, 0, "\t")) {
            // Skip headers
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $city = new City();
            $city->setRegionId($line[3]);
            $city->setDepartmentCode($line[4]);
            $city->setName(utf8_encode($line[11]));
            $city->setPrefix(substr($line[10], 1, -1));

            $cities[] = $city;
        }
        fclose($source);

        return $cities;
    }
}
