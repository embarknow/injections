<?php

namespace EmbarkNow\Tests;

use EmbarkNow\Injections\InjectionInterface;

class InjectionDummy implements InjectionInterface
{
    /**
     * Invokable for a Command Pattern style.
     *
     * @param mixed $injector
     */
    public function __invoke($injector)
    {
        // noop
    }
}
