<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 31.3.2015.
 * Time: 15:14
 */

namespace Locastic\CoreBundle\Tools\Factories;


interface ConcreteFactoryInterface
{
    function addConstructionData(array $data);
    function create();
} 