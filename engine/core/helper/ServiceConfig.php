<?php

namespace Engine\Core\Helper;

use Engine\Core\Service\Service;

class ServiceConfig
{
    /**
     * @param string $file
     * @param string $path
     * @param string $extension
     * @return null|string
     */
    public static function loadConfigFile($file = '', $path = ENGINE_FOLDER, $extension = '.php')
    {
        if (empty($file))
            return null;

        $filePath = $path.DIRECTORY_SEPARATOR.$file.$extension;

        return include $filePath;
    }

    public static function initConfig($config = [], $container)
    {
        foreach ($config as $element) {
            /**
             * @var Service $oService
             */
            $oService = new $element($container);
            $oService->init();
        }
    }
}