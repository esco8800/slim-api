<?php
/**
 * Файл Контейнера Внедрения Зависимостей
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

$container['logger'] = function ($container) {
    $settings = $container->get('settings')['logger'];

    return (new \Monolog\Logger($settings['name']))->pushHandler(
        new \Monolog\Handler\FingersCrossedHandler(
            new \Monolog\Handler\StreamHandler($settings['path'], $settings['level'], true, 0777),
            \Monolog\Logger::ERROR
        )
    );
};

$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

//Раскомментировать если требуется 404 страница
//$container['notFoundHandler'] = function ($container) {
//    return new \App\Http\Handlers\NotFoundHandler($container->get('view'));
//};

$container['errorHandler'] = function ($container) {
    return new \App\Http\Handlers\ErrorHandler($container->get('logger'));
};
