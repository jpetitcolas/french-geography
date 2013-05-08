<?php

namespace JPetitcolas\FrenchGeography\Formatter\Region;

use JPetitcolas\FrenchGeography\Formatter\FormatterInterface;

class RegionYamlFormatter extends RegionFormatter implements FormatterInterface
{
    public function format()
    {
        $output = 'regions:'.PHP_EOL.PHP_EOL;

        foreach ($this->regions as $region) {
            $output .= sprintf('    region_%d:', $region->getId()).PHP_EOL;
            $output .= sprintf('        name: "%s"', $region->getName()).PHP_EOL;
            $output .= PHP_EOL;
        }

        return $output;
    }
}
