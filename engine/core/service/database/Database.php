<?php

namespace engine\core\service\database;

use engine\core\service\Service;

class Database extends Service
{
    /**
     * @var string Имя сервиса
     */
    public $name = 'database';

    private $configFolder = ENGINE_CONFIG_FOLDER;

    private $configFile = 'db.php';

    private $configPath;

    private $configContent;

    private function setConfig($file = null, $path = null)
    {
        if (!empty($file))
            $this->configFile = $file;

        if (!empty($path))
            $this->configFolder = $path;

        $this->configPath = $this->configFolder.'/'.$this->configFile;
    }

    private function loadConfig()
    {
        $this->configContent = include($this->configPath);
    }

    /**
     * Инициализация сервиса в DI-контейнер
     */
    public function init()
    {
        $this->setConfig();

        if (is_file($this->configPath)) {
            $this->loadConfig();
        } else {
            throw new \Exception(
                '<b>Ошибка инициализации сервиса базы данных</b>: Указанного файла конфигурации базы данных не существует'
            );
        }

        $this->container->setContainer($this->name, $this);
    }
}