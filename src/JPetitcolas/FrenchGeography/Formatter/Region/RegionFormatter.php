<?php

namespace JPetitcolas\FrenchGeography\Formatter\Region;

class RegionFormatter
{
    protected $regions;

    public function __construct(array $regions)
    {
        $this->regions = $regions;
    }
}
