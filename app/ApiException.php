<?php

namespace App;


class ApiException extends \Exception
{


    public function __construct($message = '', $code = 400)
    {

        if (is_array($message)) {
            $message = implode('|', $message);
        }

        $this->message = $message;

        $this->code = $code;

    }


    public function validate()
    {

    }
}
