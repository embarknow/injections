<?php

namespace EmbarkNow\Injections;

interface InjectorInterface
{
    /**
     * Set an array of injection definitions.
     *
     * @param array $injections
     */
    public function setInjections(array $injections);

    /**
     * Add a single injection definition.
     *
     * @param string $injection
     */
    public function addInjection($injection);

    /**
     * Invokable for a Command Pattern style.
     *
     * @param mixed $additionalArguments Any additional data to pass to an InjectionInterface instance.
     */
    public function __invoke($additionalArguments = null);
}
