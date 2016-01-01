<?php

namespace EmbarkNow\Tests;

use StdClass;

/**
 * ArrayObject Test.
 */
class BlankTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->object = new StdClass();
    }

    public function getInternal($source, $object = null)
    {
        if (null === $object) {
            $object = $this->object;
        }

        $reflection = new \ReflectionClass($object);
        $property = $reflection->getProperty($source);
        $property->setAccessible(true);

        return $property->getValue($object);
    }

    public function testNothing()
    {
    }
}
