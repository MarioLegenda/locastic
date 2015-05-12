<?php

namespace Locastic\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */

class Task
{
    /**
     * @ORM\Column(type="integer", name="task_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $taskId;

    /**
     * @ORM\Column(type="integer", nullable=false, name="list_id")
     */
    private $listId;

    /**
     * @ORM\Column(type="string", length=255, nullable=false, name="task_title")
     * @Assert\NotBlank(message = "List name has to be provided")
     */
    private $taskTitle;

    /**
     * @ORM\Column(type="string", length=1, options={"fixed" = true}, nullable=false, name="priority")
     * @Assert\Length(
     *      max = 1,
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $priority;

    /**
     * @ORM\Column(type="datetime", nullable=false, name="deadline")
     */
    private $deadline;

    /**
     * @ORM\Column(type="datetime", nullable=false, name="task_created")
     */
    private $taskCreated;

    /**
     * @ORM\ManyToOne(targetEntity="Locastic\CoreBundle\Entity\ToDoList", inversedBy="task")
     * @ORM\JoinColumn(name="list_id", referencedColumnName="list_id")
     **/
    private $toDoList;

    public function setTaskId($id) {
        $this->taskId = $id;
    }

    public function getTaskId() {
        return $this->taskId;
    }

    public function setTaskTitle($title) {
        $this->taskTitle = $title;
    }

    public function getTaskTitle() {
        return $this->taskTitle;
    }

    public function setPriority($priority) {
        $this->priority = $priority;
    }

    public function getPriority() {
        return $this->priority;
    }

    public function setDeadline(\DateTime $datetime) {
        $this->deadline = $datetime;
    }

    public function getDeadline() {
        return $this->deadline;
    }

    public function setToDoList(ToDoList $list) {
        $this->toDoList = $list;
    }

    public function getToDoList() {
        return $this->toDoList;
    }

    public function setListId($id) {
        $this->listId = $id;
    }

    public function getListId() {
        return $this->listId;
    }

    public function setTaskCreated(\DateTime $created) {
        $this->taskCreated = $created;
    }

    public function getTaskCreated() {
        return $this->taskCreated;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if(new \DateTime() <= $this->getDeadline()) {
            $context->buildViolation('You cannot select past dates as deadlines')
                ->atPath('deadline')
                ->addViolation();
        }
    }
} 