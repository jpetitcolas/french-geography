<?php

namespace JPetitcolas\FrenchGeography\Formatter\Region;

use JPetitcolas\FrenchGeography\Entity\Region;
use JPetitcolas\FrenchGeography\Formatter\FormatterInterface;

class RegionSqlFormatter extends RegionFormatter implements FormatterInterface
{
    public function format()
    {
        $output  = $this->generateStructureQuery();
        $output .= PHP_EOL.PHP_EOL.'INSERT INTO `region` VALUES'.PHP_EOL;

        $sqlRecords = array();
        foreach ($this->regions as $region) {
            $sqlRecords[] = $this->generateDataQuery($region);
        }

        $output .= implode(','.PHP_EOL, $sqlRecords).';';

        return $output;
    }

    protected function generateStructureQuery()
    {
        $sql = <<<'EOL'
CREATE TABLE IF NOT EXISTS `region` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
EOL;

        return $sql;
    }

    protected function generateDataQuery(Region $region)
    {
        $sql = sprintf('(%d, "%s")', $region->getId(), $region->getName());
        return $sql;
    }
}
