<?php

namespace SmokeTest\Cache\Storage\Adapter;

use PHPUnit\Framework\TestCase;
use Smoke\Cache\Storage\Adapter\RedisArrayResourceManager;

class RedisArrayResourceManagerTest extends TestCase
{

    /**
     * The resource manager
     *
     * @var RedisArrayResourceManager
     */
    protected $resourceManager;

    public function setUp()
    {
        $this->resourceManager = new RedisArrayResourceManager();

    }

    public function testGetMajorVersion()
    {
        if (getenv('TESTS_ZEND_CACHE_REDIS_ENABLED') === true) {
            $this->markTestSkipped('Enable TESTS_ZEND_CACHE_REDIS_ENABLED to run this test');
        }

        if (! extension_loaded('redis')) {
            $this->markTestSkipped("Redis extension is not loaded");
        }

        $resourceId = __FUNCTION__;
        $resource   = [
            'servers_array' => [
                [
                    'host' => getenv('TESTS_ZEND_CACHE_REDIS_HOST') ?: 'localhost',
                    'port' => getenv('TESTS_ZEND_CACHE_REDIS_PORT') ?: 6379,
                ],
            ],
        ];
        $this->resourceManager->setResource($resourceId, $resource);
        $this->assertGreaterThan(0, $this->resourceManager->getMajorVersion($resourceId));
    }
}
