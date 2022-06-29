<?php

namespace Core;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Container\ContainerInterface;

class DB
{
    private $config;
    private $connection;

    public function __construct(ContainerInterface $container)
    {
        $config = $container->get(Config::class);
        $this->connection = $config->get('database.default');
        $this->config = $config->get('database.' . $this->connection);
        $this->eloquentSetup();
    }

    private function eloquentSetup()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => $this->config['driver'],
            'host' => $this->config['host'],
            'database' => $this->config['database'],
            'username' => $this->config['username'],
            'password' => $this->config['password'],
            'charset' => $this->config['charset'],
            'collation' => $this->config['collation'],
            'prefix' => $this->config['prefix'],
        ]);

        $capsule->setEventDispatcher(new Dispatcher(new Container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $this->eloquentCapsule = $capsule;
    }
}