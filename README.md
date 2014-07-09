RedisArray Cache Storage Adapter for ZF2
========================

This is RedisArray Cache Storage Adapter component for ZF2 inspired by \Zend\Cache\Storage\Adapter\Redis

Configuration settings
------------------------

In your config/autoload/redis-array.php put the following settings to define the servers_array:

```php
return array(
    'caches' => array(
        'Cache\General' => array(
            'adapter' => array(
                'name' => '\Smoke\Cache\Storage\Adapter\RedisArray'
            ),
            'options' => array(
                'servers_array' => array(
                    array('host' => 'host1'/*, 'port' => 1234*/),
                    array('host' => 'host2')
                ),
                //'lazy_connect' => true,
                //'connect_timeout' => 15
            ),
        ),
    ),
);
```

For the rest of the ZF2 Cache Factory needed settings follow http://framework.zend.com/manual/2.3/en/modules/zend.cache.storage.adapter.html