<?php

namespace Utils\Collections;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 *
 * @codeCoverageIgnore
 */
class InvalidTypedCollection extends TypedCollection
{
    public function __construct()
    {
        parent::__construct('');
    }
}
