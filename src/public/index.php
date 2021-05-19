<?php
/**
 * Файл загрузки
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App(\App\Helpers\Config::get('app'));
$container = $app->getContainer();

require __DIR__ . '/../bootstrap/container.php';
require __DIR__ . '/../app/routes.php';

$app->run();