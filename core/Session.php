<?php

namespace Core;

use Core\Contracts\SessionInterface;

class Session implements SessionInterface
{
    /**
     * @inheritdoc
     */
    public function get(string $key, mixed $default = null): mixed
    {
        if ($this->exists($key)) {
            return $_SESSION[$key];
        }

        return $default;
    }

    /**
     * @inheritdoc
     */
    public function set(string|array $key, mixed $value = null): void
    {
        if (is_array($key)) {
            foreach ($key as $sessionKey => $sessionValue) {
                $_SESSION[$sessionKey] = $sessionValue;
            }

            return;
        }

        $_SESSION[$key] = $value;
    }

    /**
     * @inheritdoc
     */
    public function exists(string $key): bool
    {
        return isset($_SESSION[$key]) && !empty($_SESSION[$key]);
    }

    /**
     * @inheritdoc
     */
    public function clear(...$key): void
    {
        foreach ($key as $sessionKey) {
            unset($_SESSION[$sessionKey]);
        }
    }
}