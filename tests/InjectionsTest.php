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
        $this->createInjections();
        $this->assertInstanceOf(Injections::class, $this->subject);
    }

    public function testSetsInjector()
    {
        $this->createInjectionsWithSpy();
        $injector = $this->getProperty('injector', $this->subject);

        $this->assertInstanceOf(InjectorSpy::class, $injector);
    }

    public function testSetsResolver()
    {
        $this->createInjectionsWithResolver();
        $resolver = $this->getProperty('resolver', $this->subject);

        $this->assertInstanceOf(ResolverStub::class, $resolver);
    }

    public function testSetsInjectionsArray()
    {
        $this->createInjections();
        $this->subject->setInjections([
            InjectionDummy::class,
        ]);

        $this->assertInjectionsArrayIsNotEmptyOrNull();
    }

    public function testAddsInjection()
    {
        $this->createInjections();
        $this->subject->addInjection(InjectionDummy::class);

        $this->assertInjectionsArrayIsNotEmptyOrNull();
    }

    public function testThrowsExceptionWhenClassNotExists()
    {
        $this->setExpectedException(InvalidArgumentException::class);

        $this->createInjections();
        $this->subject->addInjection('Badgers');
    }

    public function testThrowsExceptionOnAddingInvalidInjection()
    {
        $this->setExpectedException(InvalidArgumentException::class);

        $this->createInjections();
        $this->subject->addInjection(StdClass::class);
    }

    public function testAddsUniqueInjectionsOnly()
    {
        $this->createInjections();
        $this->subject->addInjection(InjectionDummy::class);
        $this->subject->addInjection(InjectionDummy::class);

        $injections = $this->getProperty('injections', $this->subject);
        $this->assertEquals(count($injections), 1);
    }

    public function testLoopsQueueOfInjections()
    {
        $this->createInjectionsWithResolverAndSpy();
        $this->subject->setInjections([
            InjectionStubOne::class,
            InjectionStubTwo::class,
        ]);

        $subject = $this->subject;
        $subject();

        $this->assertEquals($this->spy->getCount(), 2);
    }

    private function createInjections()
    {
        $this->subject = new Injections();
    }

    private function createSpy()
    {
        $this->spy = new InjectorSpy();
    }

    private function createInjectionsWithResolver()
    {
        $this->createInjections();
        $this->subject->setResolver(new ResolverStub());
    }

    private function createInjectionsWithSpy()
    {
        $this->createInjections();
        $this->createSpy();
        $this->subject->setInjector($this->spy);
    }

    private function createInjectionsWithResolverAndSpy()
    {
        $this->createInjectionsWithSpy();
        $this->subject->setResolver(new ResolverStub($this->spy));
    }

    private function assertInjectionsArrayIsNotEmptyOrNull()
    {
        $injections = $this->getProperty('injections', $this->subject);
        $this->assertNotNull($injections);
        $this->assertNotEmpty($injections);
    }
}
