<?php

namespace Core;

use Core\Contracts\LoaderInterface;

class Config
{
    protected $config = [];
    protected $cache = [];

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

    public function get($key, $default = null)
    {
        if ($this->existsInCache($key)) {
            return $this->fromCache($key);
        }

        return $this->addToCache(
            $key,
            $this->extractFromConfig($key) ?? $default
        );
    }

    protected function extractFromConfig($key)
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

    protected function fromCache($key)
    {
        return $this->cache[$key];
    }

    protected function addToCache($key, $value)
    {
        $this->cache[$key] = $value;

        return $value;
    }

    protected function existsInCache($key)
    {
        return isset($this->cache[$key]);
    }

    protected function exists(array $filter, $value)
    {
        return array_key_exists($value, $filter);
    }
}