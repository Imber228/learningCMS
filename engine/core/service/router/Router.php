<?php

namespace engine\core\service\router;

use engine\core\service\Service;

class Router extends Service
{
    public $name = 'router';

    public function init()
    {
        $this->container->setContainer($this->name, 'router service');
    }
}