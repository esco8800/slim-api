<?php
/**
 * Файл класса Swift_SendException.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace App\Mail\Exceptions;

use Swift_SwiftException;

/**
 * Исключение Swift_SendException
 *
 * @package App\Mail\Exceptions
 */
class Swift_SendException extends Swift_SwiftException
{
    /**
     * Конструктор
     *
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }
}

