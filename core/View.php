<?php

namespace Core;

use Psr\Container\ContainerInterface;
use Smarty;

class View
{
    private Smarty $smarty;
    private ContainerInterface $container;

    const TEMPLATE_DIR = __DIR__ . '/../app/Views';
    const CACHE_DIR = __DIR__ . '/../tmp/cache';
    const COMPILE_DIR = __DIR__ . '/../tmp/compiled';
    const PLUGINS_DIR = __DIR__ . '/../app/Views/smarty-plugins';

    public function __construct(ContainerInterface $container)
    {
        $this->smarty = new Smarty();
        $this->container = $container;
        $this->setupSettings();
    }

    public function render(string $template, array $data = [])
    {
        if (!empty($data)) {
            $this->smarty->assign($data);
        }

        $content = $this->smarty->fetch($template);
        $this->smarty->assign('content', $content);

        return $this->smarty->fetch('layout\app.tpl');
    }

    public function shareGlobal(string|array $var, mixed $value = null, bool $nocache = false)
    {
        if (is_array($var)) {
            foreach ($var as $key => $item) {
                $this->smarty->assignGlobal($key, $item, $nocache);
            }
        } else {
            $this->smarty->assignGlobal($var, $value, $nocache);
        }
    }

    private function setupSettings()
    {
        $config = $this->container->get(Config::class);
        $config = $config->get('view.' . $config->get('view.default'));

        $this->smarty->setTemplateDir(self::TEMPLATE_DIR);
        $this->smarty->setCompileDir(self::COMPILE_DIR);
        $this->smarty->setCacheDir(self::CACHE_DIR);

        $this->smarty->setCompileCheck($config['smarty_compile_check']);
        $this->smarty->setCaching($config['smarty_caching']);
        $this->smarty->setCacheLifetime($config['smarty_cache_lifetime']);
        $this->smarty->setDebugging($config['smarty_debugging']);
        $this->smarty->setErrorReporting(E_ALL & ~E_NOTICE);

        if (!is_dir(self::PLUGINS_DIR)) {
            @mkdir(self::PLUGINS_DIR, 0777);
        }
        if (!is_dir(self::CACHE_DIR)) {
            @mkdir(self::CACHE_DIR, 0777);
        }
        if (!is_dir(self::COMPILE_DIR)) {
            @mkdir(self::COMPILE_DIR, 0777);
        }

        $this->shareGlobal([
            'config' => $this->container->get(Config::class),
        ]);

        $this->smarty->addPluginsDir([self::PLUGINS_DIR]);
    }
}