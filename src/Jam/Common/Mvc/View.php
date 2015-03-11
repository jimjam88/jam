<?php

namespace Jam\Common\Mvc;

use Phalcon\DiInterface;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\View as PhalconView;

class View extends PhalconView
{
    /**
     * Constructor
     *
     * @param DiInterface $di  The DI
     * @param string      $dir The path to the views directory
     */
    public function __construct(DiInterface $di, $dir)
    {
        $this->setViewsDir($dir);
        $this->setLayoutsDir('layouts/');
        $this->setTemplateAfter('main');

        $this->registerEngines([
            '.volt' => function($view, $di) {
                return $this->getVoltEngine($view, $di);
            }
        ]);
    }

    /**
     * Volt engine getter.
     *
     * @param  PhalconView $view The view
     * @param  DiInterface $di   The DI
     * @return Volt
     */
    protected function getVoltEngine(PhalconView $view, DiInterface $di)
    {
        $volt = new Volt($view, $di);
        $volt->setOptions([
            'compiledPath'      => $di->getService('path')->getDefinition() . '/cache/',
            'compiledSeparator' => '_',
            'compileAlways'     => true
        ]);

        // Add additional functions to the compiler
        $compiler = $volt->getCompiler();
        $compiler->addFunction('dump', 'var_dump');
        $compiler->addFunction('strtotime', 'strtotime');
        $compiler->addFunction('json_encode', 'json_encode');
        return $volt;
    }
}
