<?php

namespace Engine\Core\Service;

abstract class Service
{
    protected $container;

    public function __construct(\Engine\Core\Container\Container $container)
    {
        $this->container = $container;
    }

    abstract function init();
}