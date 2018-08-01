<?php

namespace engine\core\service;

use engine\core\container\Container;
use ReflectionClass;

class ServiceLoader
{
    /**
     * Путь до папки файлов конфигурации
     * @var string $path
     */
    private $path = __DIR__.'/../config';

    /**
     * Имя файла конфигурации
     * @var string $file
     */
    private $file = 'service.php';

    /**
     * Полный путь до файла конфигурации
     * @var $configAddress
     */
    public $configAddress;

    /**
     * Содержимое файла конфигурации
     * @var $configContent
     */
    public $configContent;

    /**
     * Устанавливает полный путь до файла конфигурации сервисов
     * @param null $file Имя файла (установлено по умолчанию)
     * @param null $path Путь до папки файлов конфигурации (установлен по умолчанию)
     */
    public function setConfig($file = null, $path = null)
    {
        if (!empty($file))
            $this->file = $file;

        if (!empty($path))
            $this->path = $path;

        $this->configAddress = $this->path.'/'.$this->file;
    }

    /**
     * Получает содержимое файла конфигурации сервисов
     */
    private function loadConfig()
    {
        $this->configContent = include($this->configAddress);
    }

    /**
     * Инициализация сервисов на основе файла конфигурации
     * @param Container $container Объект DI-контейнера
     * @throws ServiceException Исключения
     */
    public function initServices($container)
    {
        if (is_file($this->configAddress)) {
            $this->loadConfig();
        } else {
            throw new ServiceException(
                '<b>Ошбика инициализации сервисов:</b> Файл конфигурации не существует.'
            );
        }

        if (!is_array($this->configContent)) {
            throw new ServiceException(
                '<b>Ошбика инициализации сервисов:</b> Файл конфигурации должен содержать массив.'
            );
        }

        if (empty($this->configContent)) {
            throw new ServiceException(
                '<b>Ошбика инициализации сервисов:</b> Файл конфигурации пуст.'
            );
        }

        if (!($container instanceof Container)) {
            throw new ServiceException(
                '<b>Ошбика инициализации сервисов:</b> Аргумент $container должен быть экземпляром класса \Engine\Core\Container\Container.'
            );
        }

        foreach ($this->configContent as $service) {
            try {
                $oService = new ReflectionClass($service);

                if ($oService->isAbstract())
                    throw new ServiceException(
                        '<b>Ошбика инициализации сервисов:</b> Класс <b>' . $service . '</b> Не должен быть абстрактным.'
                    );

                if (!$oService->hasMethod('init'))
                    throw new ServiceException(
                        '<b>Ошбика инициализации сервисов:</b> Класс <b>' . $service . '</b> должен иметь метод "init".'
                    );

            } catch (\ReflectionException $exception) {
                throw new ServiceException('<b>Ошбика инициализации сервисов:</b> Класс <b>' . $service . '</b> не существует.');
            } finally {
                /** @var Service $oService */
                $oService = new $service($container);

                if ($oService instanceof Service) {
                    $oService->init();
                } else {
                    throw new ServiceException(
                        '<b>Ошбика инициализации сервисов:</b> Класс <b>' . $service . '</b> не наследуется от класса Service.'
                    );
                }
            }
        }
    }
}