<?php

namespace Utils\Parameters;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 */
trait ParameterAwareTrait
{
    /**
     * The parameter instance.
     *
     * @var ParameterInterface
     */
    protected $parameter;

    /**
     * Sets a Parameter.
     *
     * @param ParameterInterface $parameter
     */
    public function setParameter(ParameterInterface $parameter)
    {
        $this->parameter = $parameter;
    }
}
