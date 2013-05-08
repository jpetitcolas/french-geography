<?php

namespace JPetitcolas\FrenchGeography\Entity;

class Department
{
    protected $regionId;
    protected $code;
    protected $chiefTown;
    protected $name;

    public function getRegionId()
    {
        return $this->regionId;
    }

    public function setRegionId($regionId)
    {
        $this->regionId = $regionId;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getChiefTown($chiefTown)
    {
        return $this->chiefTown;
    }

    public function setChiefTown($chiefTown)
    {
        $this->chiefTown = $chiefTown;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
