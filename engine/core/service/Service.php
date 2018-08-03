<?php

namespace engine\core\service;

use engine\core\container\Container;

abstract class Service
{
    /**
     * @var Container Объект DI-контейнера
     */
    protected $container;

    /**
     * Конструктор класса.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Инициализация сервиса
     * @return mixed
     */
    abstract function init();
}