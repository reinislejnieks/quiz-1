<?php

namespace Quiz\Core;

use Exception;
use Throwable;

class DependencyContainer
{
    /**  @var array */
    private $instances = [];

    /** @var array */
    private $interfaces = [];

    /**
     * Get an instance of the given class, interface or abstract class from
     * the container.
     *
     * Will return an existing instance, if any. Recursively resolves
     * dependencies.
     *
     * @param string $class
     * @return object
     * @throws Throwable
     */
    public function get(string $class)
    {
        if (array_key_exists($class, $this->interfaces)) {
            $class = $this->interfaces[$class];
        }
        if (array_key_exists($class, $this->instances)) {
            return $this->instances[$class];
        } else {
            return $this->create($class);
        }
    }

    /**
     * Create a new class.
     *
     * Will overwrite an existing instance, if any exists.
     *
     * @throws Throwable
     * @param string $class class to instantiate
     * @return object
     */
    public function create(string $class): object
    {
        $reflectionClass = new \ReflectionClass($class);
        if (!$reflectionClass->isInstantiable()) {
            throw new Exception("Cannot instantiate non-class " .
                "{$class}");
        }
        $constructor = $reflectionClass->getConstructor();
        if ($constructor === null) {
            $instance = new $class();
        } else {
            $params = $constructor->getParameters();
            $paramValues = array_map(function (\ReflectionParameter $param) {
                $type = $param->getType();
                if ($type === null) {
                    throw new Exception(
                        "Encountered an untyped constructor parameter");
                }
                $typename = $type->getName();
                return $this->get($typename);
            }, $params);
            $instance = new $class(...$paramValues);
        }
        $this->instances[$class] = $instance;
        return $instance;
    }

    /**
     * Register an existing object instance into the container.
     *
     * @param string $class
     * @param object $instance
     */
    public function register(string $class, object $instance)
    {
        $this->instances[$class] = $instance;
    }

    /**
     * Register an interface or abstract class implementation to be
     * instantiated when needed.
     *
     * @param string $interface
     * @param string $class
     */
    public function provide(string $interface, string $class)
    {
        $this->interfaces[$interface] = $class;
    }
}
