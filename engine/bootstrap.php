<?php

use Engine\Core\Application;
use Engine\Core\Container\Container;
use Engine\Core\Service\ServiceLoader;

define('ENGINE_FOLDER', __DIR__);

require_once(__DIR__.'/../vendor/autoload.php');

try {
    $oContainer = new Container();
    $oApplication = new Application($oContainer);
    $oServiceLoader = new ServiceLoader();

    $arServiceConfig = $oServiceLoader->getConfig();
    $oServiceLoader->initServices($arServiceConfig, $oContainer);

    $oApplication->start();
}
catch (\Exception $exception) {
    echo $exception->getMessage();
}