<?php
/**
 * Файл конфигурации
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

return [
    'app' => [
        'settings' => [
            'logger' => [
                'name' => 'slim-app',
                'level' => \Monolog\Logger::DEBUG,
                'path' => __DIR__ . '/../storage/logs/app.log',
            ],
        ],
    ],
    'mailer' => [
        'smtp' => [
            'host' => getenv('SMTP_HOST'),
            'port' => getenv('SMTP_PORT'),
            'username' => getenv('SMTP_USERNAME'),
            'password' => getenv('SMTP_PASSWORD'),
            'encryption' => getenv('SMTP_ENCRYPTION'),
        ],
        'from' => getenv('MAIL_FROM'),
        'to' => getenv('MAIL_TO'),
    ],
];