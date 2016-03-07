<?php

namespace EmbarkNow\Injections;

interface ResolverAwareInterface
{
    /**
     * Set a resolver implementation on a class.
     *
     * @param EmbarkNow\Injections\ResolverInterface $resolver
     */
    public function setResolver($resolver);
}
