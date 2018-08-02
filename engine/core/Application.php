<?php

namespace engine\core;

use engine\core\container\Container;
use engine\core\service\ServiceLoader;

class Application
{
    /**
     * DI-контейнер.
     * @var array
     */
    private $container = [];

    /**
     * Конструктор приложения.
     * @param Container $container Объект DI-контейнера
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function start()
    {
        $services = new ServiceLoader();
        $services->setConfig();
        $services->initServices($this->container);

        echo 'WORKING!<br>';
        print_r($this->container);
    }
}