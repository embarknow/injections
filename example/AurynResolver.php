<?php

namespace EmbarkNow\Tests;

use Auryn\Injector as AurynInjector;
use EmbarkNow\Injections\ResolverInterface;

class AurynResolver implements ResolverInterface
{
    use InjectorAwareTrait;

    /**
     * @param Auryn\Injector $injector
     */
    public function __construct(AurynInjector $injector)
    {
        $this->setInjector($injector);
    }

    /**
     * @param mixed $spec
     *
     * @return callable
     */
    public function __invoke($spec)
    {
        return $this->injector->make($spec);
    }
}
