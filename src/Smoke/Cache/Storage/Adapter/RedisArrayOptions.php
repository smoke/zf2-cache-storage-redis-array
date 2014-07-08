<?php

namespace Smoke\Cache\Storage\Adapter;

use Zend\Cache\Exception;
use Zend\Cache\Storage\Adapter\AdapterOptions;


class RedisArrayOptions extends AdapterOptions
{
    /**
     * The namespace separator
     * @var string
     */
    protected $namespaceSeparator = ':';

    /**
     * The redis resource manager
     *
     * @var null|RedisArrayResourceManager
     */
    protected $resourceManager;

    /**
     * The resource id of the resource manager
     *
     * @var string
     */
    protected $resourceId = 'default';

    /**
     * Set namespace.
     *
     * The option Redis::OPT_PREFIX will be used as the namespace.
     * It can't be longer than 128 characters.
     *
     * @param string $namespace Prefix for each key stored in redis
     * @return \Zend\Cache\Storage\Adapter\RedisArrayOptions
     *
     * @see AdapterOptions::setNamespace()
     * @see RedisArrayOptions::setPrefixKey()
     */
    public function setNamespace($namespace)
    {
        $namespace = (string) $namespace;

        if (128 < strlen($namespace)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects a prefix key of no longer than 128 characters',
                __METHOD__
            ));
        }

        return parent::setNamespace($namespace);
    }

    /**
     * Set namespace separator
     *
     * @param  string $namespaceSeparator
     * @return RedisArrayOptions
     */
    public function setNamespaceSeparator($namespaceSeparator)
    {
        $namespaceSeparator = (string) $namespaceSeparator;
        if ($this->namespaceSeparator !== $namespaceSeparator) {
            $this->triggerOptionEvent('namespace_separator', $namespaceSeparator);
            $this->namespaceSeparator = $namespaceSeparator;
        }
        return $this;
    }

    /**
     * Get namespace separator
     *
     * @return string
     */
    public function getNamespaceSeparator()
    {
        return $this->namespaceSeparator;
    }

    /**
     * Set the redis resource manager to use
     *
     * @param null|RedisArrayResourceManager $resourceManager
     * @return RedisArrayOptions
     */
    public function setResourceManager(RedisArrayResourceManager $resourceManager = null)
    {
        if ($this->resourceManager !== $resourceManager) {
            $this->triggerOptionEvent('resource_manager', $resourceManager);
            $this->resourceManager = $resourceManager;
        }
        return $this;
    }

    /**
     * Get the redis resource manager
     *
     * @return RedisArrayResourceManager
     */
    public function getResourceManager()
    {
        if (!$this->resourceManager) {
            $this->resourceManager = new RedisArrayResourceManager();
        }
        return $this->resourceManager;
    }

    /**
     * Get the redis resource id
     *
     * @return string
     */
    public function getResourceId()
    {
        return $this->resourceId;
    }

    /**
     * Set the redis resource id
     *
     * @param string $resourceId
     * @return RedisArrayOptions
     */
    public function setResourceId($resourceId)
    {
        $resourceId = (string) $resourceId;
        if ($this->resourceId !== $resourceId) {
            $this->triggerOptionEvent('resource_id', $resourceId);
            $this->resourceId = $resourceId;
        }
        return $this;
    }

    /**
     * Get the persistent id
     *
     * @return string
     */
    public function getPersistentId()
    {
        return $this->getResourceManager()->getPersistentId($this->getResourceId());
    }

    /**
     * Set the persistent id
     *
     * @param string $persistentId
     * @return RedisArrayOptions
     */
    public function setPersistentId($persistentId)
    {
        $this->triggerOptionEvent('persistent_id', $persistentId);
        $this->getResourceManager()->setPersistentId($this->getResourceId(), $persistentId);
        return $this;
    }

     /**
    * Set redis options
    *
    * @param array $libOptions
    * @return RedisArrayOptions
    * @link http://github.com/nicolasff/phpredis#setoption
    */
    public function setLibOptions(array $libOptions)
    {
        $this->triggerOptionEvent('lib_option', $libOptions);
        $this->getResourceManager()->setLibOptions($this->getResourceId(), $libOptions);
        return $this;
    }

    /**
     * Get redis options
     *
     * @return array
     * @link http://github.com/nicolasff/phpredis#setoption
     */
    public function getLibOptions()
    {
        return $this->getResourceManager()->getLibOptions($this->getResourceId());
    }

    /**
     * Set server
     *
     * Server can be described as follows:
     * - URI:   /path/to/sock.sock
     * - Assoc: array(array('host' => <host>[, 'port' => <port>[, 'timeout' => <timeout>]]))
     * - List:  array(array(<host>[, <port>, [, <timeout>]]))
     *
     * @param string|array $serversArray
     *
     * @return RedisArrayOptions
     */
    public function setServersArray($serversArray)
    {
        $this->getResourceManager()->setServersArray($this->getResourceId(), $serversArray);
        return $this;
    }

    /**
     * Get server
     *
     * @return array array(array('host' => <host>[, 'port' => <port>[, 'timeout' => <timeout>]]))
     */
    public function getServersArray()
    {
        return $this->getResourceManager()->getServersArray($this->getResourceId());
    }

    /**
     * Set resource database number
     *
     * @param int $database Database number
     *
     * @return RedisArrayOptions
     */
    public function setDatabase($database)
    {
        $this->getResourceManager()->setDatabase($this->getResourceId(), $database);
        return $this;
    }

    /**
     * Get resource database number
     *
     * @return int Database number
     */
    public function getDatabase()
    {
        return $this->getResourceManager()->getDatabase($this->getResourceId());
    }

    /**
     * Set resource password
     *
     * @param string $password Password
     *
     * @return RedisArrayOptions
     */
    public function setPassword($password)
    {
        $this->getResourceManager()->setPassword($this->getResourceId(), $password);
        return $this;
    }

    /**
     * Get resource password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getResourceManager()->getPassword($this->getResourceId());
    }

    public function setLazyConnect($lazyConnect)
    {
        return $this->getResourceManager()->setLazyConnect($this->getResourceId(), $lazyConnect);
    }

    public function getLazyConnect()
    {
        return $this->getResourceManager()->getLazyConnect($this->getResourceId());
    }

    public function setConnectTimeout($connectTimeout)
    {
        return $this->getResourceManager()->setConnectTimeout($this->getResourceId(), $connectTimeout);
    }

    public function getConnectTimeout()
    {
        return $this->getResourceManager()->getConnectTimeout($this->getResourceId());
    }

    public function setRetryInterval($retryInterval)
    {
        return $this->getResourceManager()->setRetryInterval($this->getResourceId(), $retryInterval);
    }

    public function getRetryInterval()
    {
        return $this->getResourceManager()->getRetryInterval($this->getResourceId());
    }

}
