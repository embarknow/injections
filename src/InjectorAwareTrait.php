<?php

namespace EmbarkNow\Injections;

trait InjectorAwareTrait
{
    /**
     * @var mixed
     */
    private $injector;

    /**
     * Set an injector implementation on a class.
     *
     * @param mixed $injector
     */
    public function setInjector($injector)
    {
        if (null === $this->injector) {
            $this->injector = $injector;
        }
    }
}
