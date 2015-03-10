<?php

namespace Jam\Common\Injector;

use Phalcon\DiInterface;
use Phalcon\DI\InjectionAwareInterface;

abstract class InjectorAbstract implements InjectionAwareInterface
{
    /**
     * DI
     *
     * @var DiInterface
     */
    protected $di;

    /**
     * Constructor.
     *
     * @param DiInterface $di The DI
     */
    public function __construct(DiInterface $di)
    {
        $this->setDI($di);
    }

    /**
     * Gets the DI.
     *
     * @return DiInterface
     */
    public function getDI()
    {
        return $this->di;
    }

    /**
     * Sets the DI.
     *
     * @param DiInterface $di the di
     *
     * @return self
     */
    public function setDI($di)
    {
        $this->di = $di;

        return $this;
    }
}
