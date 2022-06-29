<?php

namespace Core;

use Core\Contracts\LoaderInterface;

class Config
{
    protected $config = [];
    protected $cache = [];

    /**
     * @param array $loaders
     * @return $this
     */
    public function load(array $loaders): self
    {
        foreach ($loaders as $loader) {
            if (!$loader instanceof LoaderInterface) {
                continue;
            }

            $this->config = array_merge($this->config, $loader->parse());
        }

        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key, $default = null): mixed
    {
        if ($this->existsInCache($key)) {
            return $this->fromCache($key);
        }

        return $this->addToCache(
            $key,
            $this->extractFromConfig($key) ?? $default
        );
    }

    /**
     * @param $key
     * @return mixed
     */
    protected function extractFromConfig($key): mixed
    {
        $filter = $this->config;

        foreach (explode('.', $key) as $value) {
            if ($this->exists($filter, $value)) {
                $filter = $filter[$value];
                continue;
            }

            return false;
        }

        return $filter;
    }

    /**
     * @param string $key
     * @return mixed
     */
    protected function fromCache($key): mixed
    {
        return $this->cache[$key];
    }

    /**
     * @param string $key
     * @param string $value
     * @return mixed
     */
    protected function addToCache($key, $value): mixed
    {
        $this->cache[$key] = $value;

        return $value;
    }

    /**
     * @param string $key
     * @return bool
     */
    protected function existsInCache($key): bool
    {
        return isset($this->cache[$key]);
    }

    /**
     * @param array $filter
     * @param string $value
     * @return bool
     */
    protected function exists(array $filter, $value): bool
    {
        return array_key_exists($value, $filter);
    }
}