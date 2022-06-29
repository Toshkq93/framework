<?php

namespace Core\Contracts;

interface SessionInterface
{
    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * @param string|array $key
     * @param mixed $value
     * @return void
     */
    public function set(string|array $key, mixed $value = null): void;

    /**
     * @param string $key
     * @return bool
     */
    public function exists(string $key): bool;

    /**
     * @param ...$key
     * @return void
     */
    public function clear(...$key): void;
}