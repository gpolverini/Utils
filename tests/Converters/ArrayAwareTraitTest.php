<?php

namespace Utils\Converters;

use PHPUnit\Framework\TestCase;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 */
class ArrayAwareTraitTest extends TestCase
{
    use ArrayAwareTrait;

    /**
     * @test
     */
    public function testArrayToObject()
    {
        $config = [
            'name' => 'value',
            'name2' => [
                'child1' => '1',
                'child2' => '2'
            ]
        ];
        $result = $this->arrayToObject($config);
        $this->assertTrue(
            $result instanceof \stdClass
            && $config['name'] === $result->name
            && $config['name2']['child1'] === $result->name2->child1
            && $config['name2']['child2'] === $result->name2->child2
        );
    }
}
