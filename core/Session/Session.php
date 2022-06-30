<?php

namespace Core\Session;

use Core\Contracts\SessionInterface;

class Session implements SessionInterface
{
    public function get(string $key, mixed $default = null)
    {
        if ($this->exists($key)) {
            return $_SESSION[$key];
        }

        return $default;
    }

    public function set(string|array $key, mixed $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $sessionKey => $sessionValue) {
                $_SESSION[$sessionKey] = $sessionValue;
            }

            return;
        }

        $_SESSION[$key] = $value;
    }

    public function exists(string $key)
    {
        return isset($_SESSION[$key]) && !empty($_SESSION[$key]);
    }

    public function clear(...$key)
    {
        foreach ($key as $sessionKey) {
            unset($_SESSION[$sessionKey]);
        }
    }
}