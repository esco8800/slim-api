<?php
/**
 * Файл класса ErrorHandler.php
 *
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace App\Http\Handlers;

use Monolog\Logger;
use Slim\Handlers\Error;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Обработчик ошибки
 *
 * @package App\Http\Handlers
 */
final class ErrorHandler extends Error
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
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
        parent::__construct();
    }

    /**
     * Вызов обработчика
     *
     * @param Request $request
     * @param Response $response
     * @param \Exception $exception
     * @return Response
     */
    public function __invoke(Request $request, Response $response, \Exception $exception)
    {
        $this->logger->critical($exception->getMessage());
        return parent::__invoke($request, $response, $exception);
    }
}