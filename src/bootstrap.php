<?php

use Quiz\Repositories\UserRepository;

require_once '../vendor/autoload.php';
require_once 'config.php';
require_once 'app.php';

$container->register(UserRepository::class, new UserRepository());