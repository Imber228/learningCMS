<?php

namespace engine\core\service;

use engine\core\container\Container;

abstract class Service
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    abstract function init();
}