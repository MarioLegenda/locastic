<?php

namespace Locastic\CoreBundle\Tools\Exceptions;

class VerificationHashException extends \Exception
{
    public function __construct($message) {
        $this->message = $message;
    }
} 