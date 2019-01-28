<?php

namespace Utils\Config;

use PHPUnit\Framework\TestCase;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 */
class ConfigAwareTraitTest extends TestCase
{
    use ConfigAwareTrait;

    /**
     * @test
     */
    public function testSetConfig()
    {
        $this->assertNull($this->config);
        $config = $this->prophesize('Utils\Config\ConfigInterface');
        $config->getValues()->willReturn(null);
        try {
            $this->setConfig($config->reveal());
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof \Exception);
        }
        $this->assertNull($this->config);
        $values = [
            'name' => 'value',
            'name2' => [
                'child1' => '1',
                'child2' => '2'
            ]
        ];
        $config->getValues()->willReturn($values);
        try {
            $this->setConfig($config->reveal());
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof \Exception);
        }
        $this->assertEquals($this->config, $values);
    }
}
