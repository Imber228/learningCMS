<?php

namespace engine\core\container;

class Container
{
    private $container = [];

    /**
     * @param null $key
     * @param null $value
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
     * @param $key
     * @return mixed|null
     */
    public function getContainer($key)
    {
        if ($this->existContainer($key))
            return $this->container[$key];

        return null;
    }

    /**
     * @param $key
     * @return bool
     */
    public function existContainer($key)
    {
        return isset($this->container[$key]);
    }
}