<?php

namespace EmbarkNow\Injections;

trait ResolverAwareTrait
{
    /**
     * @var EmbarkNow\Injections\ResolverInterface
     */
    private $resolver;

    /**
     * Set a resolver implementation on a class.
     *
     * @param EmbarkNow\Injections\ResolverInterface $resolver
     */
    public function setResolver($resolver)
    {
        if (null === $this->resolver) {
            $this->resolver = $resolver;
        }
    }
}
