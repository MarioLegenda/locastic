<?php

namespace Locastic\CoreBundle\Entity;

/**
 * @ORM\Entity
 * @ORM\Table(name="to_do_list")
 */

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="integer", length=255, nullable=false)
     */
    private $listTitle;

    /**
     * @ORM\ManyToOne(targetEntity="Locastic\CoreBundle\Entity\User", inversedBy="roles")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     **/
    private $user;

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

    public function setUser(User $user) {
        $this->user = $user;
    }

    public function getUser() {
        return $this->user;
    }
} 