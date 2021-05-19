<?php
/**
 * Файл класса Controller.php
 *
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace App\Controllers;

use Monolog\Logger;
use Slim\Views\PhpRenderer;
use Psr\Container\ContainerInterface;

/**
 * Контроллер Controller
 *
 * @package App\Controllers
 */
class Controller
{
    /**
     * Представление
     *
     * @var PhpRenderer
     */
    protected $view;
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
        $this->view = $container->get('view');
        $this->logger = $container->get('logger');
    }
}