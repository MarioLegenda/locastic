<?php

namespace Locastic\CoreBundle\Repositories;


use Locastic\CoreBundle\Entity\Task;

class TaskRepository extends Repository
{
    public function addTask(Task $task) {
        $list = $this->doctrine->getRepository('LocasticCoreBundle:ToDoList')->find($task->getListId());

        $task->setToDoList($list);
        $task->setTaskCreated(new \DateTime());

        $this->manager->persist($task);
        $this->manager->flush();
    }
} 