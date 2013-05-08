<?php

namespace JPetitcolas\FrenchGeography\Formatter\City;

use JPetitcolas\FrenchGeography\Formatter\FormatterInterface;

class CityYamlFormatter extends CityFormatter implements FormatterInterface
{
    public function format()
    {
        $output = 'cities:'.PHP_EOL.PHP_EOL;

        foreach ($this->cities as $index => $city) {
            $output .= sprintf('    city_%d:', $index).PHP_EOL;
            $output .= sprintf('        name: "%s"', $city->getName()).PHP_EOL;
            $output .= sprintf('        region_id: %d', $city->getRegionId()).PHP_EOL;
            $output .= sprintf('        department_code: %s', $city->getDepartmentCode()).PHP_EOL;
            $output .= sprintf('        prefix: "%s"', $city->getPrefix()).PHP_EOL;
            $output .= PHP_EOL;
        }

        return $output;
    }
}
