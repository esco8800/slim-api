<?php
/**
 * Файл класса Config.php
 *
 * @copyright Copyright (c) 2019, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace App\Helpers;

/**
 * Хелпер Config
 *
 * @package App\Helpers
 */
class Config
{
    const BASE_CONFIG_DIR = 'config';
    const BASE_CONFIG_FILE = 'config';

    /**
     * Массив конфигурации
     *
     * @var array
     */
    protected static $config = [];

    /**
     * Загружает нужный конфигурационный файл в статический массив
     * @param string $config
     */
    public static function load($config)
    {
        static::$config = include(__DIR__ . '/../../config/' . $config . '.php');
    }

    /**
     * Возращает значение параметра по ключу
     *
     * @param string $key
     * @param string $filename
     * @return mixed
     */
    public static function get($key, $filename = self::BASE_CONFIG_FILE)
    {
        static::load($filename);
        return ArrayHelper::getValue(static::$config, $key);
    }
}