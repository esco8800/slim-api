<?php
/**
 * Файл класса HomeController.php
 *
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace App\Controllers;

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

            return $response
                ->withStatus(StatusCode::HTTP_OK)
                ->withJson(ResponseFormatter::format('Your message send successfully!'));
            $this->validateFeedback($request);

            $mailer = new SwiftMailerAdapter(Config::get('mailer.smtp'));
            $from = Config::get('mailer.from');
            $to = Config::get('mailer.to');
            $subject = 'Тема письма';
            $textMessage = "<p><strong>Имя</strong>: {$name}<br><strong>Телефон</strong>: {$phone}<br><strong>E-mail</strong>: {$email}<br></p>";
            $mailer->send($from, $to, $subject, $textMessage/*, $uploadedFile*/);

            return $response
                ->withStatus(StatusCode::HTTP_OK)
                ->withJson(ResponseFormatter::format('Your message send successfully!'));

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
     * @throws ValidationException
     */
    protected function validateFeedback(Request $request)
    {
        if (!Validator::notEmpty()->validate($name = $request->getParsedBodyParam('name'))) {
            throw new ValidationException('Wrong name.');
        }

        if (!Validator::email()->validate($email = $request->getParsedBodyParam('email'))) {
            throw new ValidationException('Wrong Email-address.');
        }

        if (!Validator::notEmpty()->validate($phone = $request->getParsedBodyParam('phone'))) {
            throw new ValidationException('Wrong phone number.');
        }
    }
}