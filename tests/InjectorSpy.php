<?php

namespace EmbarkNow\Tests;

class InjectorSpy
{
    /**
     * @var int
     */
    private $runCount;

    public function __construct()
    {
        $this->runCount = 0;
    }

    public function incrementCount()
    {
        ++$this->runCount;
    }

    public function getCount()
    {
        return $this->runCount;
    }
}
