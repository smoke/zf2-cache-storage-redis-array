<?php

namespace SmokeTest\Cache\Storage\Adapter;

use PHPUnit\Framework\TestCase;
use Smoke\Cache\Storage\Adapter\RedisArray;
use Zend\Cache\Storage\Capabilities;

/**
 * @author Maximilian Bösing <max.boesing@check24.de>
 */
class RedisArrayTest extends TestCase
{

    public function testGetCapabilities()
    {
        $instance = new RedisArray();
        $capabilities = $instance->getCapabilities();
        $this->assertInstanceOf(Capabilities::class, $capabilities);
    }
}
