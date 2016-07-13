<?php

namespace EmbarkNow\Injections;

use InvalidArgumentException;

class Injections implements InjectionsInterface, InjectorAwareInterface
{
    use InjectorAwareTrait;
    use ResolverAwareTrait;

    /**
     * @var array
     */
    private $injections;

    /**
     * Set an array of injection definitions.
     *
     * @param array $injections
     */
    public function setInjections(array $injections)
    {
        if (null === $this->injections) {
            $this->injections = [];
        }

        return array_walk($injections, ['self', 'addInjection']);
    }

    /**
     * Add a single injection definition.
     *
     * @param string $injection
     */
    public function addInjection($injection)
    {
        if (null === $this->injections) {
            $this->injections = [];
        }

        $injectionString = is_string($injection) ? $injection : get_class($injection);

        if (!class_exists($injectionString)) {
            throw new InvalidArgumentException(sprintf(
                "Injection classname string '%s' does not exist.",
                $injection
            ));
        }

        if (!is_subclass_of($injectionString, InjectionInterface::class)) {
            throw new InvalidArgumentException(sprintf(
                "Injection classname string '%s' does not implement '%s'",
                $injectionString,
                InjectionInterface::class
            ));
        }

        if (!in_array($injection, $this->injections)) {
            $this->injections[] = $injection;
        }
    }

    /**
     * Invokable for a Command Pattern style.
     *
     * @param mixed $additionalArguments Any additional data to pass to an InjectionInterface instance.
     */
    public function __invoke($additionalArguments = null)
    {
        $injector = $this->injector;
        $injectionSpec = array_shift($this->injections);

        if (null !== $injectionSpec) {
            $injection = $this->resolveInjection($injectionSpec);

            $injection($injector, $additionalArguments);

            $this();
        }
    }

    /**
     * Resolve a string spec to a callable.
     *
     * @param string $injectionSpec
     *
     * @return mixed
     */
    private function resolveInjection($injectionSpec = null)
    {
        $resolver = $this->resolver;

        return $resolver($injectionSpec);
    }
}
