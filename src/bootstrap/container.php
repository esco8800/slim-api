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

$container['FeedbackController'] = function ($container) {
    return new \App\Controllers\FeedbackController($container);
};

$container['notFoundHandler'] = function ($container) {
    return new \App\Http\Handlers\NotFoundHandler();
};

$container['errorHandler'] = function ($container) {
    return new \App\Http\Handlers\ErrorHandler($container->get('logger'));
};

$container['notAllowedHandler'] = function ($container) {
    return function ($request, $response, $methods) use ($container) {
        return $response->withStatus(405)
            ->withHeader('Allow', implode(', ', $methods))
            ->withHeader('Content-type', 'text/json')
            ->withJson(
                [
                    'message' => 'Method must be one of: ' . implode(', ', $methods),
                    'status' => 405
                ]
            );
    };
};
