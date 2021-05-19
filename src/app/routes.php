<?php
/**
 * Файл марщрутизации
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

use App\Controllers\HomeController;

$app->get('/', HomeController::class . ':index')->setName('index');
$app->get('/home', HomeController::class . ':home')->setName('home');
$app->post('/contact', HomeController::class . ':contact')->setName('contact');

