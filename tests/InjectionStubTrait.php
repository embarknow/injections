<?php

namespace EmbarkNow\Tests;

trait InjectionStubTrait
{
    private $injectorSpy;

    public function __construct($injectorSpy = null)
    {
        $this->injectorSpy = $injectorSpy;
    }

    /**
     * If this Stub has a Spy provided, then it will increment a count on the Spy to show the system is working.
     *
     * @param mixed $injector
     */
    public function __invoke($injector)
    {
        if (null !== $this->injectorSpy) {
            $this->injectorSpy->incrementCount();
        }
    }
}
