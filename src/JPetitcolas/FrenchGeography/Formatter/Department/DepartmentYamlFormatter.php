<?php

namespace JPetitcolas\FrenchGeography\Formatter\Department;

use JPetitcolas\FrenchGeography\Formatter\FormatterInterface;

class DepartmentYamlFormatter extends DepartmentFormatter implements FormatterInterface
{
    public function format()
    {
        $output = 'departments:'.PHP_EOL.PHP_EOL;

        foreach ($this->departments as $department) {
            $output .= sprintf('    department_%d:', $department->getCode()).PHP_EOL;
            $output .= sprintf('        name: "%s"', $department->getName()).PHP_EOL;
            $output .= sprintf('        region_id: %d', $department->getRegionId()).PHP_EOL;
            $output .= PHP_EOL;
        }

        return $output;
    }
}
