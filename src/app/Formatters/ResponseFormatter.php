<?php
/**
 * Файл класса ResponseFormatter.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace App\Formatters;

use Slim\Http\StatusCode;

/**
 * Форматтер ResponseFormatter
 *
 * @package App\Http
 */
class ResponseFormatter
{
    /**
     * Дополнительные данные для каждого ответа
     *
     * @var array
     */
    public static $additionalData = [];

    /**
     * Производит форматирование данных для вывода JSON
     *
     * @param array $data
     * @param int $code
     * @return array
     */
    public static function format($data = [], $code = StatusCode::HTTP_OK)
    {
        return array_merge(is_array($data) ? $data : ['message' => $data], ['code' => $code], self::$additionalData);
    }
}