<?php

namespace App\Components;

use App\Models\Feedback;

class Bitrix24Component
{
    /**
     * @param Feedback $feedback
     * @return array|mixed|string|string[]
     */
    public function sendFeedback(Feedback $feedback)
    {
        return CRest::call(
            'crm.lead.add',
            [
                'fields' => [
                    'TITLE' => 'Новый лид с сайта',
                    'NAME' => $feedback->name,
                    'EMAIL[0][VALUE]' => $feedback->email,
                    'FIELDS[EMAIL][0][VALUE_TYPE]' => 'WORK',
                    'FIELDS[PHONE][0][VALUE]' => $feedback->phone,
                    'FIELDS[PHONE][0][VALUE_TYPE]' => 'WORK',
                ]
            ]
        );
    }
}