<?php

namespace EmbarkNow\Tests;

use EmbarkNow\Injections\ResolverInterface;

class ResolverStub implements ResolverInterface
{
    private $injectorSpy;

    public function __construct($injectorSpy = null)
    {
        $this->injectorSpy = $injectorSpy;
    }

    /**
     * @param mixed $spec
     *
     * @return callable
     */
    public function __invoke($spec)
    {
        if (null !== $this->injectorSpy) {
            return new $spec($this->injectorSpy);
        }

        return new $spec();
    }
}
