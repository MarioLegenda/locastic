<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 10.5.2015.
 * Time: 18:15
 */

namespace Locastic\CoreBundle\Tools\Exceptions;


class FileException extends \Exception
{
    public function __construct($message) {
        $this->message = $message;
    }
} 