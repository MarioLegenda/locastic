<?php

namespace Locastic\CoreBundle\Entity;

use Locastic\CoreBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="email_verification")
 */
class EmailVerification
{
    /**
     * @ORM\Column(type="integer", name="email_verification_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    private $emailVerificationId;

    /**
     * @ORM\Column(type="integer", nullable=false, name="user_id")
     */
    private $userId;

    /**
     * @ORM\Column(type="string", length=40, options={"fixed" = true}, name="verification_hash")
     */
    private $verificationHash;

    /**
     * @ORM\OneToOne(targetEntity="Locastic\CoreBundle\Entity\User", mappedBy="user", cascade="persist")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     **/
    private $user;

    public function setEmailVerificationId($id) {
        $this->emailVerificationId = $id;
    }

    public function getEmailVerificationId() {
        return $this->emailVerificationId;
    }

    public function setUserId($id) {
        $this->userId = $id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setVerificationHash($verHash) {
        $this->verificationHash = $verHash;
    }

    public function getVerificationHash() {
        return $this->verificationHash;
    }

    public function setUser(User $user) {
        $this->user = $user;
    }

    public function getUser() {
        return $this->user;
    }
} 