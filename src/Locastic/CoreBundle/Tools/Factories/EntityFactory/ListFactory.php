<?php

namespace Locastic\CoreBundle\Tools\Factories\EntityFactory;

use Locastic\CoreBundle\Entity\ToDoList;
use Locastic\CoreBundle\Tools\Factories\ConcreteFactoryInterface;

class ListFactory  implements ConcreteFactoryInterface
{
    private $data;

    public function addConstructionData(array $data) {
        $this->data = $data;
    }

    public function create() {
        $list = new ToDoList();
        $list->setListName($this->data['name']);

        return $list;
    }
} 