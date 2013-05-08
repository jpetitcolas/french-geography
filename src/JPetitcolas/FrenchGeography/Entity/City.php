<?php

namespace JPetitcolas\FrenchGeography\Entity;

class City
{
    protected $regionId;
    protected $departmentCode;
    protected $name;
    protected $prefix;

    public function getRegionId()
    {
        return $this->regionId;
    }

    public function setRegionId($regionId)
    {
        $this->regionId = $regionId;
    }

    public function getDepartmentCode()
    {
        return $this->departmentCode;
    }

    public function setDepartmentCode($departmentCode)
    {
        $this->departmentCode = $departmentCode;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }
}
