<?php

namespace JPetitcolas\FrenchGeography\Formatter\Department;

use JPetitcolas\FrenchGeography\Entity\Department;
use JPetitcolas\FrenchGeography\Formatter\FormatterInterface;

class DepartmentSqlFormatter extends DepartmentFormatter implements FormatterInterface
{
    public function format()
    {
        $output  = $this->generateStructureQuery();
        $output .= PHP_EOL.PHP_EOL.'INSERT INTO `department` VALUES'.PHP_EOL;

        $sqlRecords = array();
        foreach ($this->departments as $department) {
            $sqlRecords[] = $this->generateDataQuery($department);
        }

        $output .= implode(','.PHP_EOL, $sqlRecords).';'.PHP_EOL;

        return $output;
    }

    protected function generateStructureQuery()
    {
        $sql = <<<'EOL'
CREATE TABLE IF NOT EXISTS `department` (
  `code` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `region_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY  (`code`),
  KEY `region_id` (`region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
EOL;

        return $sql;
    }

    protected function generateDataQuery(Department $department)
    {
        $sql = sprintf('("%s", "%s", %d)',
            $department->getCode(),
            $department->getName(),
            $department->getRegionId()
        );

        return $sql;
    }
}
