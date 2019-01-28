<?php

namespace Utils\Parameters;

/**
 * Exception interface for invalid parameter arguments.
 *
 * When an invalid argument is passed it must throw an exception which implements
 * this interface
 */
interface InvalidArgumentException extends ParameterException
{
}
