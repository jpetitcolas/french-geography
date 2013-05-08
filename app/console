#!/usr/bin/env php
<?php

$loader = require(__DIR__.'/../vendor/autoload.php');
$loader->add('JPetitcolas', __DIR__.'/../src');

use JPetitcolas\FrenchGeography\Command\GenerateListCommand;

use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new GenerateListCommand);
$application->run();
