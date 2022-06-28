<?php

namespace Core;

use Psr\Container\ContainerInterface;
use Smarty;

class View
{
    private Smarty $smarty;
    private array $config;

    const TEMPLATE_DIR = __DIR__ . '/../app/views';
    const CACHE_DIR = __DIR__ . '/../tmp/cache';
    const COMPILE_DIR = __DIR__ . '/../tmp/compiled';
    const PLUGINS_DIR = __DIR__ . '/../app/views/smarty-plugins';

    public function __construct(ContainerInterface $container)
    {
        $this->smarty = new Smarty();
        $config = $container->get(Config::class);
        $this->config = $config->get('view.' . $config->get('view.default'));

        $this->setupSettings();
    }

    /**
     * @param string $templateFilename
     * @param array $data
     * @return void
     * @throws \SmartyException
     */
    public function render(string $templateFilename, array $data = [])
    {
        $content = $this->fetch($templateFilename);

        if (!empty($data)){
            $this->smarty->assign($data);
        }
        $this->smarty->assign('content', $content);

        header("Content-type: text/html; charset=UTF-8");
        print $this->fetch('layout\app.tpl');
        die;
    }

    /**
     * @param $tpl_var
     * @param $value
     * @param $nocache
     * @return Smarty
     */
    public function assign($tpl_var, $value = null, $nocache = false): Smarty
    {
        return $this->smarty->assign($tpl_var, $value, $nocache);
    }

    /**
     * @param string $template
     * @return string
     * @throws \SmartyException
     */
    public function fetch(string $template): string
    {
        return $this->smarty->fetch($template);
    }

    /**
     * @return void
     */
    private function setupSettings(): void
    {
        $this->smarty->setTemplateDir(self::TEMPLATE_DIR);
        $this->smarty->setCompileDir(self::COMPILE_DIR);
        $this->smarty->setCacheDir(self::CACHE_DIR);

        $this->smarty->setCompileCheck($this->config['smarty_compile_check']);
        $this->smarty->setCaching($this->config['smarty_caching']);
        $this->smarty->setCacheLifetime($this->config['smarty_cache_lifetime']);
        $this->smarty->setDebugging($this->config['smarty_debugging']);
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

        $this->smarty->addPluginsDir([self::PLUGINS_DIR]);
    }
}