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
} 