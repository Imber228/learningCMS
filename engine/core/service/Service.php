<?php

namespace engine\core\service;

abstract class Service
{
    protected $container;

    public function __construct(\engine\core\container\container $container)
    {
        $this->container = $container;
    }

    abstract function init();
}