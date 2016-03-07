<?php

namespace EmbarkNow\Injections;

interface InjectionInterface
{
    /**
     * Invokable for a Command Pattern style.
     *
     * @param mixed $injector
     */
    public function __invoke($injector);
}
