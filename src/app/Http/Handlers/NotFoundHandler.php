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
     * @var PhpRenderer
     */
    protected $view;

    /**
     * Конструктор
     *
     * @param PhpRenderer $view
     */
    public function __construct(PhpRenderer $view)
    {
        $this->view = $view;
    }

    /**
     * Вызов обработчика
     *
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function __invoke(Request $request, Response $response)
    {
        return $this->view->render($response->withStatus(StatusCode::HTTP_NOT_FOUND), '404.php');
    }
}
