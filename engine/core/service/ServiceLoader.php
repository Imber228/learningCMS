<?php

namespace engine\core\service;

use engine\core\container\Container;
use ReflectionClass;

class ServiceLoader
{
    /**
     * Путь до папки файлов конфигурации
     * @var string $folder
     */
    private $folder = __DIR__.'/../config';

    /**
     * Имя файла конфигурации
     * @var string $file
     */
    private $file = 'service.php';

    /**
     * Полный путь до файла конфигурации
     * @var string $configPath
     */
    public $configPath;

    /**
     * Содержимое файла конфигурации
     * @var array $configContent
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
            $this->folder = $path;

        $this->configPath = $this->folder.'/'.$this->file;
    }

    /**
     * Получает содержимое файла конфигурации сервисов
     */
    private function loadConfig()
    {
        $this->configContent = include($this->configPath);
    }

    /**
     * Инициализация сервисов на основе файла конфигурации
     * @param Container $container Объект DI-контейнера
     * @throws ServiceException Исключения
     */
    public function initServices($container)
    {
        if (is_file($this->configPath)) {
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

        foreach ($this->configContent as $namespace) {
            try {
                $service = new ReflectionClass($namespace);

                if ($service->isAbstract())
                    throw new ServiceException(
                        '<b>Ошбика инициализации сервисов:</b> Класс <b>' . $namespace . '</b> Не должен быть абстрактным.'
                    );

                if (!$service->hasMethod('init'))
                    throw new ServiceException(
                        '<b>Ошбика инициализации сервисов:</b> Класс <b>' . $namespace . '</b> должен иметь метод "init".'
                    );

            } catch (\ReflectionException $exception) {
                throw new ServiceException('<b>Ошбика инициализации сервисов:</b> Класс <b>' . $namespace . '</b> не существует.');
            } finally {
                /**
                 * @var Service $service
                 */
                $service = new $namespace($container);

                if ($service instanceof Service) {
                    $service->init();
                } else {
                    throw new ServiceException(
                        '<b>Ошбика инициализации сервисов:</b> Класс <b>' . $namespace . '</b> не наследуется от класса Service.'
                    );
                }
            }
        }
    }
}