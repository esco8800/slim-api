<?php
/**
 * Файл класса ArrayHelper.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace App\Helpers;

/**
 * Хелпер ArrayHelper
 *
 * @package App\Helpers
 */
class ArrayHelper
{
    /**
     * Получить значение вложенного массива по ключу в формате "x.y.z"
     *
     * @param array $array
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public static function getValue($array, $key, $default = null)
    {
        if (is_null($key)) {
            return $array;
        }

        if (isset($array[$key])) {
            return $array[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return $default;
            }
            $array = $array[$segment];
        }

        return $array;
    }
}