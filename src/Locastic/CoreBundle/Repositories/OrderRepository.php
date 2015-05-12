<?php

namespace Locastic\CoreBundle\Repositories;

use Doctrine\ORM\Query;
use EntityToArray\EntityToArray;

class OrderRepository extends Repository
{
    private $types = array();

    public function __construct($doctrine) {
        parent::__construct($doctrine);

        $this->types['list']['name'] = function($order) {
            $qb = $this->manager->createQueryBuilder();

            $lists = $qb->select(array('tl'))
                ->from('LocasticCoreBundle:ToDoList', 'tl')
                ->orderBy('tl.listName', $order)
                ->getQuery()
                ->getResult();

            $eta = new EntityToArray($lists, array(
                'getListName',
                'getListCreated'
            ));

            $listsArray = $namesAsArray = $eta->config(array(
                'methodName-keys' => true,
                'multidimensional' => false,
                'only-names' => true
            ))->toArray();

            return $listsArray;
        };

        $this->types['list']['date'] = function($order) {
            $qb = $this->manager->createQueryBuilder();

            $lists = $qb->select(array('tl'))
                ->from('LocasticCoreBundle:ToDoList', 'tl')
                ->orderBy('tl.listCreated', $order)
                ->getQuery()
                ->getResult();

            $eta = new EntityToArray($lists, array(
                'getListName',
                'getListCreated',
                'getListId'
            ));

            $listsArray = $namesAsArray = $eta->config(array(
                'methodName-keys' => true,
                'multidimensional' => false,
                'only-names' => true
            ))->toArray();

            return $listsArray;
        };

        $this->types['task']['name'] = function($order) {
            $qb = $this->manager->createQueryBuilder();

            $tasks = $qb->select(array('t'))
                ->from('LocasticCoreBundle:Task', 't')
                ->orderBy('t.taskTitle', $order)
                ->getQuery()
                ->getResult();

            foreach($tasks as $task) {
                $task->setPriority(null, function($priority) {
                    switch($priority) {
                        case '1': return 'Low';
                        case '2': return 'Normal';
                        case '3': return 'High';
                    }
                });

                $status = $task->getIsFinished();

                $task->setIsFinished(($status === 0) ? 'Pending' : 'Finished');
            }

            $eta = new EntityToArray($tasks, array(
                'getTaskTitle',
                'getIsFinished',
                'getDeadline',
                'getPriority',
                'getTaskCreated',
                'getTaskId'
            ));

            $tasksArray = $namesAsArray = $eta->config(array(
                'methodName-keys' => true,
                'multidimensional' => false,
                'only-names' => true
            ))->toArray();



            return $tasksArray;
        };

        $this->types['task']['date'] = function($order) {
            $qb = $this->manager->createQueryBuilder();

            $tasks = $qb->select(array('t'))
                ->from('LocasticCoreBundle:Task', 't')
                ->orderBy('t.taskCreated', $order)
                ->getQuery()
                ->getResult();

            foreach($tasks as $task) {
                $task->setPriority(null, function($priority) {
                    switch($priority) {
                        case '1': return 'Low';
                        case '2': return 'Normal';
                        case '3': return 'High';
                    }
                });

                $status = $task->getIsFinished();

                $task->setIsFinished(($status === 0) ? 'Pending' : 'Finished');
            }

            $eta = new EntityToArray($tasks, array(
                'getTaskTitle',
                'getIsFinished',
                'getDeadline',
                'getPriority',
                'getTaskCreated',
                'getTaskId'
            ));

            $tasksArray = $namesAsArray = $eta->config(array(
                'methodName-keys' => true,
                'multidimensional' => false,
                'only-names' => true
            ))->toArray();



            return $tasksArray;
        };

        $this->types['task']['deadline'] = function($order) {
            $qb = $this->manager->createQueryBuilder();

            $tasks = $qb->select(array('t'))
                ->from('LocasticCoreBundle:Task', 't')
                ->orderBy('t.deadline', $order)
                ->getQuery()
                ->getResult();

            foreach($tasks as $task) {
                $task->setPriority(null, function($priority) {
                    switch($priority) {
                        case '1': return 'Low';
                        case '2': return 'Normal';
                        case '3': return 'High';
                    }
                });

                $status = $task->getIsFinished();

                $task->setIsFinished(($status === 0) ? 'Pending' : 'Finished');
            }

            $eta = new EntityToArray($tasks, array(
                'getTaskTitle',
                'getIsFinished',
                'getDeadline',
                'getPriority',
                'getTaskCreated',
                'getTaskId'
            ));

            $tasksArray = $namesAsArray = $eta->config(array(
                'methodName-keys' => true,
                'multidimensional' => false,
                'only-names' => true
            ))->toArray();



            return $tasksArray;
        };

        $this->types['task']['priority'] = function($order) {
            $qb = $this->manager->createQueryBuilder();

            $tasks = $qb->select(array('t'))
                ->from('LocasticCoreBundle:Task', 't')
                ->orderBy('t.deadline', $order)
                ->getQuery()
                ->getResult();

            foreach($tasks as $task) {
                $task->setPriority(null, function($priority) {
                    switch($priority) {
                        case '1': return 'Low';
                        case '2': return 'Normal';
                        case '3': return 'High';
                    }
                });

                $status = $task->getIsFinished();

                $task->setIsFinished(($status === 0) ? 'Pending' : 'Finished');
            }

            $eta = new EntityToArray($tasks, array(
                'getTaskTitle',
                'getIsFinished',
                'getDeadline',
                'getPriority',
                'getTaskCreated',
                'getTaskId'
            ));

            $tasksArray = $namesAsArray = $eta->config(array(
                'methodName-keys' => true,
                'multidimensional' => false,
                'only-names' => true
            ))->toArray();



            return $tasksArray;
        };
    }

    public function getLists($order, $type, $entity) {
        return $this->types[$entity][$type]->__invoke($order);
    }
} 