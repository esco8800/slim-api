<?php
/**
 * Файл класса HomeController.php
 *
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace App\Controllers;

use App\Components\Bitrix24Component;
use App\Models\Feedback;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Helpers\Config;
use Slim\Http\StatusCode;
use App\Mail\SwiftMailerAdapter;
use Respect\Validation\Validator;
use App\Formatters\ResponseFormatter;
use Respect\Validation\Exceptions\ValidationException;

/**
 * Контроллер HomeController
 *
 * @package App\Controllers
 */
class FeedbackController extends Controller
{
    /**
     * Отправка формы обратной связи
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function feedback(Request $request, Response $response)
    {
        try {
            $feedback = $this->getFeedback($request);
            $feedback->validate();
            $this->sendFeedback($feedback);

            return $response
                ->withStatus(StatusCode::HTTP_OK)
                ->withJson(ResponseFormatter::format('Your feedback send successfully!'));

        } catch (ValidationException $e) {
            return $response
                ->withStatus(StatusCode::HTTP_BAD_REQUEST)
                ->withJson(ResponseFormatter::format($e->getMessage(), StatusCode::HTTP_BAD_REQUEST));
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return $response
                ->withStatus(StatusCode::HTTP_INTERNAL_SERVER_ERROR)
                ->withJson(ResponseFormatter::format('Service temporarily unavailable.', StatusCode::HTTP_INTERNAL_SERVER_ERROR));
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function getFeedback(Request $request)
    {
        return new Feedback(
            $request->getParsedBodyParam('name'),
            $request->getParsedBodyParam('email'),
            $request->getParsedBodyParam('phone'),
            $request->getParsedBodyParam('consentPd'),
            $request->getParsedBodyParam('consentRules')
        );
    }

    /**
     * @param Feedback $feedback
     */
    protected function sendFeedback(Feedback $feedback)
    {
        $component = new Bitrix24Component();
        $bitrixRes = $component->sendFeedback($feedback);
    }
}