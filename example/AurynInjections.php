<?php

namespace EmbarkNow\Example;

use Auryn\Injector as AurynInjector;
use EmbarkNow\Injections\Injections;
use EmbarkNow\Injections\ResolverInterface;

class AurynInjections extends Injections
{
    public function __construct(AurynInjector $injector, ResolverInterface $aurynResolver)
    {
        $this->setInjector($aurynInjector);
        $this->setResolver($aurynResolver);
    }
}
