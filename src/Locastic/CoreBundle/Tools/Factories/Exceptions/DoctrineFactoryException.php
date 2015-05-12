<?php

namespace Locastic\CoreBundle\Tools\Factories\Exceptions;


class DoctrineFactoryException extends \Exception
{
    public function __construct($message) {
        $this->message = $message;
    }
} 