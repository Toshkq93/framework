<?php

namespace Core;

use DI\Container;

class ContainerInstance
{
    protected static $container;

    /**
     * @param Container $container
     * @return void
     */
    public static function set(Container $container): void
    {
        self::$container = $container;
    }

    /**
     * @return Container
     */
    public static function get(): Container
    {
        return self::$container;
    }
}