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

    public function deleteTask(array $content) {
        $task = $this->doctrine->getRepository('LocasticCoreBundle:Task')->find($content['taskId']);

        $this->manager->remove($task);
        $this->manager->flush();
    }

    public function modifyTask(array $content) {
        $task = $this->doctrine->getRepository('LocasticCoreBundle:Task')->find($content['taskId']);

        if(empty($task)) {
            return null;
        }

        $task->setTaskTitle($content['name']);
        $task->setDeadline($content['deadline']);
        $task->setPriority($content['priority']);

        $this->manager->persist($task);
        $this->manager->flush();
    }
} 