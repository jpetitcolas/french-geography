<?php

namespace JPetitcolas\FrenchGeography\Formatter\City;

class CityFormatter
{
    protected $cities;

    public function __construct(array $cities)
    {
        $this->cities = $cities;
    }
}
