<?php

namespace Utils\Parameters;

use PHPUnit\Framework\TestCase;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 */
class ParameterAwareTraitTest extends TestCase
{
    use ParameterAwareTrait;

    /**
     * @test
     */
    public function testSetParameter()
    {
        $this->assertNull($this->parameter);
        $parameter = $this->createMock('Utils\Parameters\ParameterInterface');
        $this->setParameter($parameter);
        $this->assertTrue($this->parameter instanceof ParameterInterface);
    }
}
