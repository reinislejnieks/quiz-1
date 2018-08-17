<?php


use Quiz\Core\DependencyContainer;

$container = new DependencyContainer;

if (!function_exists('app')) {
    function app($className)
    {
        global $container;

        return $container->get($className);
    }
}