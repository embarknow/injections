<?php

namespace EmbarkNow\Tests;

trait GetPropertyTrait
{
    public function getProperty($source, $subject = null)
    {
        if (null === $subject) {
            $subject = $this->subject;
        }

        $reflection = new \ReflectionClass($subject);
        $property = $reflection->getProperty($source);
        $property->setAccessible(true);

        return $property->getValue($subject);
    }
}
