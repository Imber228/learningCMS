<?php

namespace engine\core;

class Application
{
    private $container = [];

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function start()
    {
        echo 'WORKING!<br>';
        print_r($this->container);
    }
}