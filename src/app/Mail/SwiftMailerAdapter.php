<?php
/**
 * Файл класса SwiftMailerAdapter.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace App\Mail;

use App\Mail\Exceptions\Swift_SendException;
use Slim\Http\UploadedFile;
use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;
use Swift_Plugins_LoggerPlugin;
use Swift_Plugins_Loggers_ArrayLogger;
use Swift_SmtpTransport;

/**
 * Адаптер SwiftMailerAdapter
 *
 * @package App\Mail
 */
class SwiftMailerAdapter implements MailerInterface
{
    /**
     * @var Swift_SmtpTransport
     */
    protected $transport;
    /**
     * @var Swift_Mailer
     */
    protected $mailer;
    /**
     * @var Swift_Plugins_LoggerPlugin
     */
    protected $logger;

    /**
     * Конструктор
     *
     * @param array $smtpConfig
     */
    public function __construct($smtpConfig = [
        'host' => 'localhost',
        'port' => '25',
        'username' => '',
        'password' => '',
        'encryption' => null
    ])
    {
        $this->setTransport($smtpConfig);
    }

    /**
     * Выполняет отпарвку Email-письма по указанным реквизитам
     *
     * @param string|array $from
     * @param string|array $to
     * @param string $subject
     * @param string $message
     * @param UploadedFile $attachment
     *
     * @return int
     * @throws Swift_SendException
     */
    public function send($from, $to, $subject, $message, $attachment = null)
    {
        if ($send = $this->getMailer()->send($this->composeMessage($from, $to, $subject, $message, $attachment)) !== 0) {
            return $send;
        }

        throw new Swift_SendException($this->logger->dump());
    }

    /**
     * Подготавливает объект транспорта
     *
     * @param array $config
     */
    protected function setTransport($config)
    {
        $this->transport = (new Swift_SmtpTransport());
        foreach ($config as $param => $value) {
            $setter = "set" . ucfirst($param);
            $this->transport->$setter($value);
        }
    }

    /**
     * Возвращает объект транспорта
     *
     * @return Swift_SmtpTransport
     */
    protected function getTransport()
    {
        return $this->transport;
    }

    /**
     * Подготавливает и возвращает объект-отправщик
     *
     * @return \Swift_Mailer
     */
    protected function getMailer()
    {
        if ($this->mailer === null) {
            $this->mailer = new Swift_Mailer($this->getTransport());
            $this->logger = new Swift_Plugins_Loggers_ArrayLogger();
            $this->mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($this->logger));
        }

        return $this->mailer;
    }

    /**
     * Сборка сообщения для отправки
     *
     * @param string|array $from
     * @param string|array $to
     * @param string $subject
     * @param string $message
     * @param UploadedFile $attachment
     * @return Swift_Message
     */
    protected function composeMessage($from, $to, $subject, $message, $attachment = null)
    {
        $message = (new Swift_Message())
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($message, 'text/html');

        if ($attachment) {
            $message->attach(
                Swift_Attachment::fromPath($attachment->file)->setFilename($attachment->getClientFilename())
            );
        }

        return $message;
    }
}