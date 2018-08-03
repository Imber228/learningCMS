<?php

namespace engine\core\service\database;

use engine\core\service\Service;
use engine\core\service\database\classes\Database;

class Provider extends Service
{
    /**
     * @var string Имя сервиса
     */
    public $name = 'database';

    /**
     * @var object Обект главного класса сервиса
     */
    private $object;


    /**
     * Инициализация сервиса
     */
    public function init()
    {
        $this->object = new Database();
        $this->container->setContainer($this->name, $this->object);
    }
}