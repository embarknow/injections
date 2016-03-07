<?php

namespace EmbarkNow\Injections;

interface ResolverInterface
{
    /**
     * @param mixed $spec
     *
     * @return callable
     */
    public function __invoke($spec);
}
