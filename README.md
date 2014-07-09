RedisArray Cache Storage Adapter for ZF2
========================

This is RedisArray Cache Storage Adapter component for ZF2 inspired by \Zend\Cache\Storage\Adapter\Redis

Installation
------------

This module only officially supports installation through Composer. For Composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

You can install the module from command line:
```sh
$ php composer.phar require smoke/zf2-cache-storage-redis-array:1.0.*
```

Alternatively, you can also add manually the dependency in your `composer.json` file:
```json
{
    "require": {
        "smoke/zf2-cache-storage-redis-array": "1.0.*"
    }
}
```

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

### LICENSE

The files in this archive are released under the MIT license.
You can find a copy of this license in [LICENSE.txt](LICENSE.txt).

