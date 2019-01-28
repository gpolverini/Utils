<?php

namespace Utils;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 *
 * @codeCoverageIgnore
 */
class TestModel
{
    protected $propertyOne;
    protected $propertyTwo;

    public function __construct()
    {
        $this->propertyOne = '';
        $this->propertyTwo = '';
    }

    /**
     * getPropertyOne.
     */
    public function getPropertyOne()
    {
        return $this->propertyOne;
    }

    /**
     * setPropertyOne.
     *
     * @param $propertyOne
     */
    public function setPropertyOne($propertyOne)
    {
        $this->propertyOne = $propertyOne;
    }

    /**
     * getPropertyTwo.
     */
    public function getPropertyTwo()
    {
        return $this->propertyTwo;
    }

    /**
     * setPropertyTwo.
     *
     * @param $propertyTwo
     */
    public function setPropertyTwo($propertyTwo)
    {
        $this->propertyTwo = $propertyTwo;
    }
}
