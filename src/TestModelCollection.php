<?php

namespace Utils;

use Utils\Collections\TypedCollection;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 *
 * @codeCoverageIgnore
 */
class TestModelCollection extends TypedCollection
{
    public function __construct()
    {
        parent::__construct('Utils\TestModel');
    }
}
