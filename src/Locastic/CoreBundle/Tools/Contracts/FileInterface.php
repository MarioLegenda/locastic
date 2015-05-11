<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 11.5.2015.
 * Time: 14:58
 */

namespace Locastic\CoreBundle\Tools\Contracts;


interface FileInterface
{
    function createFile($path);
    function getFile();
    function closeFile();
    function write($value);
} 