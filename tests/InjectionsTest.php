<?php

namespace EmbarkNow\Tests;

use StdClass;
use InvalidArgumentException;
use EmbarkNow\Injections\Injections;

class InjectionsTest extends \PHPUnit_Framework_TestCase
{
    use GetPropertyTrait;

    private $injector;

    private $spy;

    private $resolver;

    public function testCreatesInstance()
    {
        $this->createInjector();
        $this->assertInstanceOf(Injections::class, $this->subject);
    }

    public function testSetsInjector()
    {
        $this->createInjectorWithSpy();
        $injector = $this->getProperty('injector', $this->subject);

        $this->assertInstanceOf(InjectorSpy::class, $injector);
    }

    public function testSetsResolver()
    {
        $this->createInjectorWithResolver();
        $resolver = $this->getProperty('resolver', $this->subject);

        $this->assertInstanceOf(ResolverStub::class, $resolver);
    }

    public function testSetsInjectionsArray()
    {
        $this->createInjector();
        $this->subject->setInjections([
            InjectionDummy::class,
        ]);

        $this->assertInjectionsArrayIsNotEmptyOrNull();
    }

    public function testAddsInjection()
    {
        $this->createInjector();
        $this->subject->addInjection(InjectionDummy::class);

        $this->assertInjectionsArrayIsNotEmptyOrNull();
    }

    public function testThrowsExceptionOnAddingNonStringInjection()
    {
        $this->setExpectedException(InvalidArgumentException::class);

        $this->createInjector();
        $this->subject->addInjection(new StdClass());
    }

    public function testThrowsExceptionOnAddingInvalidInjection()
    {
        $this->setExpectedException(InvalidArgumentException::class);

        $this->createInjector();
        $this->subject->addInjection(StdClass::class);
    }

    public function testAddsUniqueInjectionsOnly()
    {
        $this->createInjector();
        $this->subject->addInjection(InjectionDummy::class);
        $this->subject->addInjection(InjectionDummy::class);

        $injections = $this->getProperty('injections', $this->subject);
        $this->assertEquals(count($injections), 1);
    }

    public function testLoopsQueueOfInjections()
    {
        $this->createInjectorWithResolverAndSpy();
        $this->subject->setInjections([
            InjectionStubOne::class,
            InjectionStubTwo::class,
        ]);

        $subject = $this->subject;
        $subject();

        $this->assertEquals($this->spy->getCount(), 2);
    }

    private function createInjector()
    {
        $this->subject = new Injections();
    }

    private function createSpy()
    {
        $this->spy = new InjectorSpy();
    }

    private function createInjectorWithResolver()
    {
        $this->createInjector();
        $this->subject->setResolver(new ResolverStub());
    }

    private function createInjectorWithSpy()
    {
        $this->createInjector();
        $this->createSpy();
        $this->subject->setInjector($this->spy);
    }

    private function createInjectorWithResolverAndSpy()
    {
        $this->createInjectorWithSpy();
        $this->subject->setResolver(new ResolverStub($this->spy));
    }

    private function assertInjectionsArrayIsNotEmptyOrNull()
    {
        $injections = $this->getProperty('injections', $this->subject);
        $this->assertNotNull($injections);
        $this->assertNotEmpty($injections);
    }
}
