<?php

use Quiz\Controllers\BaseController;

require_once '../src/bootstrap.php';

define('BASE_DIR', __DIR__ . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');
define('VIEW_DIR', SOURCE_DIR . '/views');
define('TEMPLATE_DIR', SOURCE_DIR . '/templates');

$requestUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$requestString = substr($requestUrl, strlen($baseUrl));

$urlParams = explode('/', $requestString);
$controllerName = ucfirst(array_shift($urlParams));
$controllerName = $controllerNamespace . ($controllerName ? $controllerName : 'Index') . 'Controller';
$actionName = strtolower(array_shift($urlParams));
$actionName = ($actionName ? $actionName : 'index') . 'Action';

/** @var BaseController $controller */
$controller = app($controllerName);
$controller->handleCall($actionName);