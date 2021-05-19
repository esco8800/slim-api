<?php
/**
 * Файл класса Controller.php
 *
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace App\Controllers;

use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Slim\Http\Response;

/**
 * Контроллер Controller
 *
 * @package App\Controllers
 */
class Controller
{
    /**
     * Логгер
     *
     * @var Logger
     */
    protected $logger;

    /**
     * Конструктор
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get('logger');
    }
}