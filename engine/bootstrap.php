<?php

use engine\core\Application;
use engine\core\container\Container;

require_once(__DIR__.'/../vendor/autoload.php');

try {
    $container = new Container();
    $application = new Application($container);

    $application->start();
}
catch (\Exception $exception) {
    echo $exception->getMessage();
}