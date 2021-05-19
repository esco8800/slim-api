<?php
/**
 * Файл марщрутизации
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 *
 * @var \Slim\App $app
 */

use App\Controllers\FeedbackController;

$app->post('/feedback', FeedbackController::class . ':feedback')->setName('feedback');