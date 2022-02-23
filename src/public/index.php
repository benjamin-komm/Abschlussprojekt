<?php

use core\MVC\MainController;
use core\ProjectConfig;
use core\Router;

define('APP_PROJECT_ROOT', realpath(__DIR__ . '/../'));
define('APP_APPLICATION_ROOT', realpath(__DIR__ . '/../application/'));
define('APP_CORE_ROOT', realpath(__DIR__ . '/../application/core/'));

require_once APP_CORE_ROOT . '/bootstrap.php';

$confSource = parse_ini_file(APP_APPLICATION_ROOT . '/config/env.conf', true);
$config = new ProjectConfig($confSource);

require_once APP_APPLICATION_ROOT . $config->get('files', 'routesMap');

$router = new Router($map);

define('APP_ASSETS_ROOT', realpath(APP_PROJECT_ROOT . $config->get('directories', 'assets')));
define('APP_VIEWS_ROOT', realpath(APP_APPLICATION_ROOT . $config->get('directories', 'views')));
define('ACTIVE_PAGE', $router->getActivePage());

$mainController = new MainController();
$mainController->setConfig($config);
$mainController->setRouter($router);
$mainController->start();
