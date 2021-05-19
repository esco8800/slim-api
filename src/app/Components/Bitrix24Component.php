<?php

namespace App\Components;

use App\Models\Feedback;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class Bitrix24Component
{
    /**
     * @var Client
     */
    protected $client;

    public function sendFeedback(Feedback $feedback)
    {

    }

    /**
     * Получение HTTP клиента.
     * С предворительной инициализацией и дефолтной конфигурацией
     *
     * @return Client
     */
    protected function getClient()
    {
        if (is_null($this->client)) {
            $this->client = new Client([
                RequestOptions::VERIFY => false,
            ]);
        }
        return $this->client;
    }

}