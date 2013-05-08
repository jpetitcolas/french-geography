<?php

namespace JPetitcolas\FrenchGeography\Formatter\City;

use JPetitcolas\FrenchGeography\Entity\City;
use JPetitcolas\FrenchGeography\Formatter\FormatterInterface;

class CitySqlFormatter extends CityFormatter implements FormatterInterface
{
    public function format()
    {
        $output  = $this->generateStructureQuery();
        $output .= PHP_EOL.PHP_EOL.'INSERT INTO `city` VALUES'.PHP_EOL;

        $sqlRecords = array();
        foreach ($this->cities as $city) {
            $sqlRecords[] = $this->generateDataQuery($city);
        }

        $output .= implode(','.PHP_EOL, $sqlRecords).';';

        return $output;
    }

    protected function generateStructureQuery()
    {
        $sql = <<<'EOL'
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `region_id` tinyint(3) unsigned NOT NULL,
  `department_code` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `prefix` varchar(3),
  PRIMARY KEY  (`id`),
  KEY `region_id` (`region_id`),
  KEY `department_code` (`department_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
EOL;

        return $sql;
    }

    protected function generateDataQuery(City $city)
    {
        $sql = sprintf('(NULL, %d, "%s", "%s", "%s")',
            $city->getRegionId(),
            $city->getDepartmentCode(),
            $city->getName(),
            $city->getPrefix()
        );

        return $sql;
    }
}
