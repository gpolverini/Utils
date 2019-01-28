<?php

namespace Utils\Config;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 */
interface ConfigInterface
{
    /**
     * Fetches all values from the config.
     *
     * @return mixed The value of the item from the parameters, or $default in case of cache miss.
     */
    public function getValues();
}
