<?php

// Here's a very overly simple example of this package in play.
// While this will not run without adding Auryn to the composer file, it shows a simple example.
// To run this, `composer require rdlowrey\auryn` in this package.

use Auryn\Injector;
use EmbarkNow\Example;

// Prepare the injector
$injector = new Injector();
$injector->share($injector);

// Make a resolver to transform the strings into actua classes.
// The example provided is very simple and only expects actual classnames.
$resolver = $injector->make(Example\AurynResolver::class);
$injector->share($resolver);

// Make the injections instance
$injections = $injector->make(Example\AurynInjections::class);

// Add an injection
$injections->addInjection(Example\TestClassInjection::class);

// Run the injections. This can accept arbitrary data which will be passed on to each injection as a second (or more), non-declared parameter(s) for `__invoke`
$injections();

// Test this worked out ok
$testClass = $injector->make(Example\TestClass::class);

echo $testClass->returnString(); // expected 'Hello World'
