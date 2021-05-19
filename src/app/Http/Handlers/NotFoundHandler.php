<?php
/**
 * Файл класса NotFoundHandler.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace App\Http\Handlers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;
use Slim\Views\PhpRenderer;

/**
 * Обработчик NotFoundHandler
 *
 * @package App\Http\Handlers
 */
class NotFoundHandler
{
    /**
     * Вызов обработчика
     *
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function __invoke(Request $request, Response $response)
    {
        return $response->withJson([
            'message' => 'Not Found',
            'status' => 404
        ])->withStatus(404);
    }
}
