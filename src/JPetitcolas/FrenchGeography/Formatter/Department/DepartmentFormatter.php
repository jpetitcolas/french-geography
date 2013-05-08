<?php

namespace JPetitcolas\FrenchGeography\Formatter\Department;

class DepartmentFormatter
{
    protected $departments;

    public function __construct(array $departments)
    {
        $this->departments = $departments;
    }
}
