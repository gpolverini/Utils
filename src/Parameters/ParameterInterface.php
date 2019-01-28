<?php

namespace Utils\Parameters;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 */
interface ParameterInterface
{
    /**
     * Fetches a value from the parameters.
     *
     * @param string $key     The unique key of this item in the parameters.
     * @param mixed  $default Default value to return if the key does not exist.
     *
     * @return mixed The value of the item from the parameters, or $default in case of cache miss.
     *
     * @throws \Utils\Parameters\InvalidArgumentException
     *   MUST be thrown if the $key string is not a legal value.
     */
    public function getValue($key, $default = null);
}
