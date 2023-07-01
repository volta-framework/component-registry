<?php
/*
 * This file is part of the Volta package.
 *
 * (c) Rob Demmenie <rob@volta-framework.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Volta\Component\Registry;

use ArrayAccess;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

use Volta\Component\Registry\NotFoundException as NotFoundException;
use Volta\Component\Registry\Exception as ContainerException;

/**
 * Dependency manager providing *psr/container-implementation 1.0.0.*
 *
 * @implements ArrayAccess<string, mixed>
 */
 class Container implements ContainerInterface, ArrayAccess
{

    #region - Construction:

     /**
      * Public Constructor to use as a standalone Container
      */
     public function __construct()
     {}

    /**
     * The singleton instance
     *
     * @ignore Do not show in generated documentation
     * @var Container|null
     */
    protected static Container|null $_instance = null;

    /**
     * Sets the singletons instance
     *
     * @param Container|null $container
     * @return void
     * @throws Exception
     */
    public static function setInstance(Container|null $container): void
    {
        if(null !== static::$_instance) {
            throw new ContainerException('Container Singleton already set, call Container::unsetInstance() first');
        }
        if(null !== $container) {
            static::$_instance = $container;
        } else {
            static::$_instance = new Container();
        }
    }

    /**
     * Gets the singleton instance
     *
     * @return Container
     * @throws Exception
     */
    public static function getInstance(): Container
    {
        if(null === static::$_instance) {
            throw new ContainerException('Container Singleton not set yet call Container::setInstance() first');
        }
        return static::$_instance;
    }

    /**
     * Unsets the singletons instance
     *
     * @return void
     * @throws Exception
     */
    public static function unsetInstance(): void
    {
        if(null === static::$_instance) {
            throw new ContainerException('Container Singleton not set yet call Container::setInstance() first');
        }
        static::$_instance = null;
    }

    /**
     * Returns the value indexed by __$id__
     *
     * @param string $id
     * @param mixed|null $default
     * @return mixed
     * @throws NotFoundExceptionInterface|Exception|ContainerExceptionInterface
     */
    public static function item(string $id, mixed $default=null): mixed
    {
        if(!static::getInstance()->has($id) && null!==$default) {
            return $default;
        }
        return static::getInstance()->get($id);
    }

    /**
     * @ignore Do not show in generated documentation
     * @var array<string, mixed>
     */
    protected array $_items = [];

    /**
     * Sets the value indexed by __$id__
     *
     * @param string $id
     * @param mixed $entry
     * @return ContainerInterface
     * @throws ContainerExceptionInterface
     */
    public function set(string $id, mixed $entry): ContainerInterface
    {
        if ($this->has($id)) {
            throw new ContainerException(sprintf('Duplicate entry: %s', $id));
        }
        $this->_items[$id] = $entry;
        return $this;
    }

    /**
     * Unsets the value indexed by __$id__
     *
     * @param string $id
     * @return ContainerInterface
     */
    public function unset(string $id): ContainerInterface
    {
        if ($this->has($id)) unset($this->_items[$id]);
        return $this;
    }

    #endregion

    #region - ContainerInterface stubs:

    /**
     * @inheritdoc
     */
    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new NotFoundException(sprintf('Entry %s not found', $id));
        }
        if (is_callable($this->_items[$id])) {
            return call_user_func($this->_items[$id]);
        }
        return $this->_items[$id];
    }

    /**
     * @inheritdoc
     */
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->_items);
    }

    #endregion

    #region - ArrayAccess stubs:

     /**
      * @inheritdoc
      * @see https://www.php.net/manual/en/arrayaccess.offsetexists.php
      */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has((string) $offset);
    }

    /**
     * @inheritdoc
     * @see https://www.php.net/manual/en/arrayaccess.offsetGet.php
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get((string) $offset);
    }

     /**
      * @inheritdoc
      * @see https://www.php.net/manual/en/arrayaccess.offsetSet.php
      * @throws ContainerExceptionInterface
      */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->set((string) $offset, $value);
    }

     /**
      * @inheritdoc
      * @see https://www.php.net/manual/en/arrayaccess.offsetUnset.php
      */
    public function offsetUnset(mixed $offset): void
    {
        $this->unset((string) $offset);
    }

    #endregion

}