<?php

namespace Utils\Config;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 */
trait ConfigAwareTrait
{
    /**
     * The config instance.
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * Sets a Config.
     *
     * @param ConfigInterface $configInterface
     * @throws \Exception
     */
    public function setConfig(ConfigInterface $configInterface)
    {
        $values = $configInterface->getValues();
        if (!(is_array($values) || $values instanceof \Traversable)) {
            throw new \Exception();
        }

        $this->config = $values;
    }
}
