<?php

namespace EmbarkNow\Injections;

interface InjectorAwareInterface
{
    /**
     * Set an injector implementation on a class.
     *
     * @param mixed $injector
     */
    public function setInjector($injector);
}
