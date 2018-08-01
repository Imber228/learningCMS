<?php

use engine\core\Application;
use engine\core\container\Container;
use engine\core\service\ServiceLoader;

require_once(__DIR__.'/../vendor/autoload.php');

try {
    $oContainer = new Container();
    $oApplication = new Application($oContainer);

    $oServiceLoader = new ServiceLoader();
    $oServiceLoader->setConfig();
    $oServiceLoader->initServices($oContainer);

    $oApplication->start();
}
catch (\Exception $exception) {
    echo $exception->getMessage();
}