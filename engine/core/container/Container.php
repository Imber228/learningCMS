<?php

namespace engine\core\container;

class Container
{
    /**
     * DI-контейнер
     * @var array
     */
    private $container = [];

    /**
     * Помещает объект в DI-контейнер с заданным ключом
     * @param null $key Ключ в DI-контейнере
     * @param null $value Передаваемый объект
     * @return $this|null
     */
    public function setContainer($key = null, $value = null)
    {
        if (empty($key) || empty($value))
            return null;

        $this->container[$key] = $value;

        return $this;
    }

    /**
     * Возвращает элемент из DI-контейнера по указанному ключу
     * @param string $key Запрашиваемый ключ в DI-контейнере
     * @return mixed|null
     */
    public function getContainer($key)
    {
        if ($this->existContainer($key))
            return $this->container[$key];

        return null;
    }

    /**
     * Проверяет на существование ключа в DI-контейнере
     * @param string $key Запрашиваемый ключ
     * @return bool
     */
    public function existContainer($key)
    {
        return isset($this->container[$key]);
    }
}