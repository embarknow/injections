<?php

namespace EmbarkNow\Example;

use EmbarkNow\Injections\InjectionInterface;

class TestClassInjection implements InjectionInterface
{
    public function __invoke($injector)
    {
        // You can use any method on Auryn in here

        $injector->define(TestClass::class, [
            ':valueOne' => 'Hello',
        ]);

        $injector->prepare(TestClass::class, function ($instance, $injector) {
            $instance->setValueTwo('World');
        });
    }
}
