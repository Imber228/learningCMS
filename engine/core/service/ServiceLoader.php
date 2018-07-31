<?php

namespace Engine\Core\Service;

use Engine\Core\Container\Container;
use ReflectionClass;

class ServiceLoader
{
    private $configPath = __DIR__.'/../config/';

    private $configFile = 'service';

    private $configExtension = '.php';

    public $config = [];

    public function getConfig($file = null, $path = null, $extension= null)
    {
        if (empty($file))
            $file = $this->configFile;

        if (empty($path))
            $path = $this->configPath;

        if (empty($extension))
            $extension = $this->configExtension;

        $this->config = include $path.$file.$extension;

        return $this->config;
    }

    /**
     * @param $config
     * @param Container $container
     * @throws \ReflectionException
     */
    public function initServices($config, $container)
    {
        if (!empty($config)) {
            foreach ($config as $service) {
                try {
                    $oService = new ReflectionClass($service);
                } catch (\ReflectionException $exception) {
                    throw new ServiceException('Class ' . $service . ' does not exists');
                } finally {
                    /**
                     * @var Service $oService
                     */
                    $oService = new $service($container);
                    $oService->init();
                }
            }
        }
    }
}