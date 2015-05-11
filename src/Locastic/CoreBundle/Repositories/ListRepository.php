<?php

namespace Locastic\CoreBundle\Repositories;


use Locastic\CoreBundle\Entity\ToDoList;
use Locastic\CoreBundle\Entity\User;

class ListRepository extends Repository
{
    public function createList(array $content, User $user) {
        throw new \Exception();
        $list = new ToDoList();
        $list->setListTitle($content['name']);
        $list->setListCreated(new \DateTime());
        $list->setUser($user);

        $this->manager->persist($list);
        $this->manager->flush();
    }
} 