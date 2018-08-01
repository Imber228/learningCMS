<?php

namespace engine\core\service\database;

use engine\core\service\Service;

class Database extends Service
{

    public $name = 'database';

    public function init() {
        $this->container->setContainer($this->name, 'database connection info');
    }
}