<?php

namespace EmbarkNow\Example;

class TestClass
{
    /**
     * @var string
     */
    private $valueOne;

    /**
     * @var string
     */
    private $valueTwo;

    /**
     * @param string $valueOne
     */
    public function __construct($valueOne)
    {
        $this->valueOne = $valueOne;
    }

    /**
     * @param string $valueTwo
     */
    public function setValueTwo($valueTwo)
    {
        $this->valueTwo = $valueTwo;
    }

    /**
     * @return string
     */
    public function returnString()
    {
        return $this->valueOne.' '.$this->valueTwo;
    }
}
