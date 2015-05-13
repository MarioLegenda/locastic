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
            $lists = $qb = $this->manager->createQuery('
                    SELECT
                       l.listId AS listid,
                       l.listName AS listname,
                       l.listCreated AS listcreated,
                       (SELECT COUNT(tk.taskId) FROM LocasticCoreBundle:Task tk WHERE tk.listId = l.listId ) AS total_tasks,
                       (SELECT COUNT(ts.taskId) FROM LocasticCoreBundle:Task ts WHERE ts.listId = l.listId AND ts.isFinished = 0) AS unfinished,
                       (SELECT COUNT(ta.taskId) FROM LocasticCoreBundle:Task ta WHERE ta.listId = l.listId AND ta.isFinished = 1) AS finished
                    FROM LocasticCoreBundle:ToDoList l
                    JOIN LocasticCoreBundle:Task t WHERE t.taskId = l.listId
                    ORDER BY l.listCreated ' . $order)
                ->getResult(Query::HYDRATE_ARRAY);


            array_walk($lists, function(&$item, $index) {
                $item['completed'] = ($item['finished'] / $item['total_tasks']) * 100;
            });

            return $lists;
        };

        $this->types['list']['date'] = function($order) {
            $lists = $qb = $this->manager->createQuery('
                    SELECT
                       l.listId AS listid,
                       l.listName AS listname,
                       l.listCreated AS listcreated,
                       (SELECT COUNT(tk.taskId) FROM LocasticCoreBundle:Task tk WHERE tk.listId = l.listId ) AS total_tasks,
                       (SELECT COUNT(ts.taskId) FROM LocasticCoreBundle:Task ts WHERE ts.listId = l.listId AND ts.isFinished = 0) AS unfinished,
                       (SELECT COUNT(ta.taskId) FROM LocasticCoreBundle:Task ta WHERE ta.listId = l.listId AND ta.isFinished = 1) AS finished
                    FROM LocasticCoreBundle:ToDoList l
                    JOIN LocasticCoreBundle:Task t WHERE t.taskId = l.listId
                    ORDER BY l.listCreated ' . $order)
                ->getResult(Query::HYDRATE_ARRAY);


            array_walk($lists, function(&$item, $index) {
                $item['completed'] = ($item['finished'] / $item['total_tasks']) * 100;
            });

            return $lists;
        };

        $this->types['task']['date'] = function($order, $listId) {
            $qb = $this->manager->createQueryBuilder();

            $tasks = $qb->select(array('t'))
                ->from('LocasticCoreBundle:Task', 't')
                ->where($qb->expr()->eq('t.listId', ':list_id'))
                ->orderBy('t.taskCreated', $order)
                ->setParameter(':list_id', $listId)
                ->getQuery()
                ->getResult();

            return $this->taskRefactoring($tasks);
        };

        $this->types['task']['deadline'] = function($order, $listId) {
            $qb = $this->manager->createQueryBuilder();

            $tasks = $qb->select(array('t'))
                ->from('LocasticCoreBundle:Task', 't')
                ->where($qb->expr()->eq('t.listId', ':list_id'))
                ->orderBy('t.deadline', $order)
                ->setParameter(':list_id', $listId)
                ->getQuery()
                ->getResult();

            $tasksArray = $this->taskRefactoring($tasks);


            return $tasksArray;
        };

        $this->types['task']['priority'] = function($order, $listId) {
            $qb = $this->manager->createQueryBuilder();

            $tasks = $qb->select(array('t'))
                ->from('LocasticCoreBundle:Task', 't')
                ->where($qb->expr()->eq('t.listId', ':list_id'))
                ->orderBy('t.priority', $order)
                ->setParameter(':list_id', $listId)
                ->getQuery()
                ->getResult();

            return $this->taskRefactoring($tasks);
        };

        $this->types['task']['name'] = function($order, $listId) {
            $qb = $this->manager->createQueryBuilder();

            $tasks = $qb->select(array('t'))
                ->from('LocasticCoreBundle:Task', 't')
                ->where($qb->expr()->eq('t.listId', ':list_id'))
                ->orderBy('t.taskTitle', $order)
                ->setParameter(':list_id', $listId)
                ->getQuery()
                ->getResult();

            return $this->taskRefactoring($tasks);
        };
    }

    public function getLists(array $content) {
        $order = $content['order'];
        $type = $content['type'];
        $entity = $content['entity'];
        $listId = (array_key_exists('listId', $content) === true) ? $content['listId'] : null;

        return $this->types[$entity][$type]->__invoke($order, $listId);
    }

    private function taskRefactoring($tasks) {
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
    }
} 