<?php
/**
 * Файл интерфейса MailerInterface.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace App\Mail;

/**
 * Интерфейс MailerInterface
 *
 * @package App\Mail
 */
interface MailerInterface
{
    /**
     * Выполняет отпарвку Email-письма по указанным реквизитам
     *
     * @param string|array $from
     * @param string|array $to
     * @param string $subject
     * @param string $message
     * @return int
     */
    public function send($from, $to, $subject, $message);
}