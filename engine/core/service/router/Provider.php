<?php

namespace engine\core\service\router;

use engine\core\service\Service;
use engine\core\service\router\classes\Router;

class Provider extends Service
{
    /**
     * @var string Имя сервиса
     */
    public $name = 'router';

    /**
     * @var object Объект главного класса сервиса
     */
    private $object;

    /**
     * Инициализация сервиса
     */
    public function init()
    {
        $this->object = new Router();
        $this->container->setContainer($this->name, $this->object);
    }
}