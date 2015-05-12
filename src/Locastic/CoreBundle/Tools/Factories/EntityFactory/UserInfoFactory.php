<?php

namespace App\ToolsBundle\Helpers\Factories\EntityFactory;


use Locastic\CoreBundle\Tools\Factories\ConcreteFactoryInterface;

class UserInfoFactory implements ConcreteFactoryInterface
{
    private $data;

    public function addConstructionData(array $data) {
        $this->data = $data;
    }

    public function create() {
    }
} 