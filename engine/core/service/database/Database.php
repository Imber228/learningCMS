<?php

namespace Engine\Core\Service\Database;

use Engine\Core\Service\Service;

class Database extends Service
{

    public $name = 'Database';

    public function init() {
        $this->container->setContainer($this->name, 'database connection info');
    }
}