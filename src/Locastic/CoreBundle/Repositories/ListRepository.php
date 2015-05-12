<?php

namespace Locastic\CoreBundle\Repositories;


use Doctrine\ORM\Query;
use Locastic\CoreBundle\Entity\ToDoList;
use Locastic\CoreBundle\Entity\User;

class ListRepository extends Repository
{
    public function createList(array $content, User $user) {
        $list = new ToDoList();
        $list->setListName($content['name']);
        $list->setListCreated(new \DateTime());
        $list->setUser($user);

        $this->manager->persist($list);
        $this->manager->flush();
    }

    public function deleteList(array $content) {
        $qb = $this->manager->createQueryBuilder();

        $tasks = $qb->select(array('t'))
            ->from('LocasticCoreBundle:Task', 't')
            ->where($qb->expr()->eq('t.listId', ':list_id'))
            ->setParameter(':list_id', $content['listId'])
            ->getQuery()
            ->getResult();

        foreach($tasks as $task) {
            $this->manager->remove($task);
        }

        $this->manager->flush();

        $list = $this->doctrine->getRepository('LocasticCoreBundle:ToDoList')->find($content['listId']);

        $this->manager->remove($list);

        $this->manager->flush();
    }
} 