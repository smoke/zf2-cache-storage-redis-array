<?php
/**
 * @see       https://github.com/zendframework/zend-cache for the canonical source repository
 * @copyright Copyright (c) 2018 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-cache/blob/master/LICENSE.md New BSD License
 */

namespace PsrTest\SimpleCache;

use Cache\IntegrationTests\SimpleCacheTest;
use PackageVersions\Versions;
use Smoke\Cache\Storage\Adapter\RedisArray;
use Zend\Cache\Psr\SimpleCache\SimpleCacheDecorator;
use Zend\Cache\Storage\Adapter\Redis;
use Zend\Cache\Storage\Plugin\Serializer;
use Zend\Cache\Exception;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

class RedisIntegrationTest extends SimpleCacheTest
{
    /**
     * Backup default timezone
     * @var string
     */
    private $tz;

    /**
     * @var Redis
     */
    private $storage;

    protected function setUp()
    {
        if (version_compare(Versions::getVersion('zendframework/zend-cache'), '2.8', '<')) {
            $this->markTestSkipped('Cannot test simple-cache compatibility for `zend-cache` less than v2.8');
        }

        // set non-UTC timezone
        $this->tz = date_default_timezone_get();
        date_default_timezone_set('America/Vancouver');

        parent::setUp();
    }

    protected function tearDown()
    {
        date_default_timezone_set($this->tz);

        if ($this->storage) {
            $this->storage->flush();
        }

        parent::tearDown();
    }

    public function createSimpleCache()
    {
        $options = ['resource_id' => __CLASS__];

        if (getenv('TESTS_ZEND_CACHE_REDIS_HOST') && getenv('TESTS_ZEND_CACHE_REDIS_PORT')) {
            $options['servers_array'] = [
                [getenv('TESTS_ZEND_CACHE_REDIS_HOST'), getenv('TESTS_ZEND_CACHE_REDIS_PORT')]
            ];
        } elseif (getenv('TESTS_ZEND_CACHE_REDIS_HOST')) {
            $options['servers_array'] = [[getenv('TESTS_ZEND_CACHE_REDIS_HOST')]];
        }

        if (getenv('TESTS_ZEND_CACHE_REDIS_DATABASE')) {
            $options['database'] = getenv('TESTS_ZEND_CACHE_REDIS_DATABASE');
        }

        if (getenv('TESTS_ZEND_CACHE_REDIS_PASSWORD')) {
            $options['password'] = getenv('TESTS_ZEND_CACHE_REDIS_PASSWORD');
        }

        try {
            $storage = new RedisArray($options);
            $storage->addPlugin(new Serializer());
            $this->storage = $storage;
            return new SimpleCacheDecorator($storage);
        } catch (Exception\ExtensionNotLoadedException $e) {
            $this->markTestSkipped($e->getMessage());
        } catch (ServiceNotCreatedException $e) {
            if ($e->getPrevious() instanceof Exception\ExtensionNotLoadedException) {
                $this->markTestSkipped($e->getMessage());
            }
            throw $e;
        }
    }
}
