<?php

namespace Locastic\CoreBundle\Repositories;


use Doctrine\ORM\Query;
use Locastic\CoreBundle\Entity\ToDoList;
use Locastic\CoreBundle\Entity\User;

class ListRepository extends Repository
{
    public function createList(array $content, User $user) {
        $list = new ToDoList();
        $list->setListTitle($content['name']);
        $list->setListCreated(new \DateTime());
        $list->setUser($user);

        $this->manager->persist($list);
        $this->manager->flush();
    }

    /**
     * Returns all created lists
     */
    public function getLists() {
        $qb = $this->manager->createQueryBuilder();

        $lists = $qb->select(array('tl'))
            ->from('LocasticCoreBundle:ToDoList', 'tl')
            ->orderBy('tl.listCreated', 'ASC')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
        
        return $lists;
    }
} 