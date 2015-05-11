<?php

namespace Locastic\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="to_do_list")
 */

class ToDoList
{
    /**
     * @ORM\Column(type="integer", name="list_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $listId;

    /**
     * @ORM\Column(type="integer", nullable=false, name="user_id")
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $listTitle;

    /**
     * @ORM\Column(type="datetime", nullable=false, name="list_created")
     */
    private $listCreated;

    /**
     * @ORM\ManyToOne(targetEntity="Locastic\CoreBundle\Entity\User", inversedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     **/
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Locastic\CoreBundle\Entity\Task", mappedBy="toDoList")
     **/
    private $task;

    public function setListId($listId) {
        $this->listId = $listId;
    }

    public function getListId() {
        return $this->listId;
    }

    public function setUserId($userId) {
        $this->user_id = $userId;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setListTitle($title) {
        $this->listTitle = $title;
    }

    public function getListTitle() {
        return $this->listTitle;
    }

    public function setListCreated(\DateTime $datetime) {
        $this->listCreated = $datetime;
    }

    public function getListCreated() {
        return $this->listCreated;
    }

    public function setUser(User $user) {
        $this->user = $user;
    }

    public function getUser() {
        return $this->user;
    }

    public function setTask(Task $task) {
        $this->task = $task;
    }

    public function getTask() {
        return $this->task;
    }
} 