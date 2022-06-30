<?php

namespace Core\Contracts;

interface SessionInterface
{
    public function get(string $key, mixed $default = null);

    public function set(string|array $key, mixed $value = null);

    public function exists(string $key);

    public function clear(...$key);
}