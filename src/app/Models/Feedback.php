<?php

namespace App\Models;

use Psr\Container\ContainerInterface;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;

class Feedback
{
    public $name;
    public $email;
    public $phone;
    public $consentPd;
    public $consentRules;


    public function __construct(
        $name,
        $email,
        $phone,
        $consentPd,
        $consentRules
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->consentPd = $consentPd;
        $this->consentRules = $consentRules;
    }

    public function validate()
    {
        if (!Validator::notEmpty()->validate($this->name)) {
            throw new ValidationException('Wrong name.');
        }

        if (!Validator::email()->validate($this->email)) {
            throw new ValidationException('Wrong Email-address.');
        }

        if (!Validator::phone()->validate($this->phone)) {
            throw new ValidationException('Wrong phone number.');
        }

        if (!Validator::trueVal()->validate($this->consentPd)) {
            throw new ValidationException('Wrong consentPd.');
        }

        if (!Validator::trueVal()->validate($this->consentRules)) {
            throw new ValidationException('Wrong consentRules.');
        }

    }

}