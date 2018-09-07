<?php

namespace SmokeTest\Cache\Storage\Adapter;

use PHPUnit\Framework\TestCase;
use Smoke\Cache\Storage\Adapter\RedisArray;
use Smoke\Cache\Storage\Adapter\RedisArrayOptions;
use Smoke\Cache\Storage\Adapter\RedisArrayResourceManager;
use Zend\Cache\Storage\Capabilities;

/**
 * @author Maximilian Bösing <max.boesing@check24.de>
 */
class RedisArrayTest extends TestCase
{

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
    }

    public function testGetCapabilities()
    {
        $options = $this->getMockBuilder(RedisArrayOptions::class)->getMock();
        $resourceManager = $this->getMockBuilder(RedisArrayResourceManager::class)->getMock();

        $options
            ->expects($this->once())
            ->method('getResourceManager')
            ->willReturn($resourceManager);

        $options
            ->expects($this->any())
            ->method('toArray')
            ->willReturn([]);

        $instance = new RedisArray($options);
        $capabilities = $instance->getCapabilities();
        $this->assertInstanceOf(Capabilities::class, $capabilities);
    }
}
