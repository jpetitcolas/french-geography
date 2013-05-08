<?php

namespace JPetitcolas\FrenchGeography\Parser\Insee;

use JPetitcolas\FrenchGeography\Parser\Parser;
use JPetitcolas\FrenchGeography\Parser\ParserInterface;

use JPetitcolas\FrenchGeography\Entity\Department;

class InseeDepartmentParser extends Parser implements ParserInterface
{
    public function parse()
    {
        if (!$this->sourcePath) {
            throw new \Exception('Try to parse with no file set.');
        }

        $firstLine = true;
        $departments = array();

        $source = fopen($this->sourcePath, 'r');
        while ($line = fgetcsv($source, 0, "\t")) {
            // Skip headers
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $department = new Department();
            $department->setRegionId($line[0]);
            $department->setCode($line[1]);
            $department->setChiefTown($line[2]);
            $department->setName($line[5]);

            $departments[] = $department;
        }
        fclose($source);

        return $departments;
    }
}
