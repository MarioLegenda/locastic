<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 12.5.2015.
 * Time: 19:59
 */

namespace Locastic\CoreBundle\Tools\Factories\EntityFactory;


use Locastic\CoreBundle\Entity\Task;

class TaskFactory
{
    private $data;

    public function addConstructionData(array $data) {
        $this->data = $data;
    }

    public function create() {
        $task = new Task();
        $task->setListId($this->data['listId']);
        $task->setTaskTitle($this->data['name']);
        $task->setPriority($this->data['priority']);
        $task->setDeadline($this->data['deadline']);
        $task->setIsFinished(0);

        return $task;
    }
} 