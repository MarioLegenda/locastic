<?php

namespace Locastic\CoreBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */

class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(message = "Username has to be provided")
     * @Assert\Email(message = "Username has to be a valid email")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max = 4096)
     * @Assert\NotBlank(message = "Password has to be provided")
     * @Assert\Length(
     *      min = 8,
     *      max = 4096,
     *      minMessage = "Password has to be at least 8 characters long",
     * )
     */
    private $password;

     /**
     * @Assert\Length(max = 4096)
     * @Assert\NotBlank(message = "Confirmed password has to be provided")
     * @Assert\Length(
     *      min = 8,
     *      max = 4096,
     *      minMessage = "Password has to be at least 8 characters long",
     * )
     */
    private $passRepeat;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(message = "Name has to be provided")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(message = "Lastname has to be provided")
     */
    private $lastname;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $registered;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $lastLogin;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=40, options={"fixed" = true}, name="verification_hash")
     */
    private $verificationHash;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $verified;

    /**
     * @ORM\OneToMany(targetEntity="Locastic\CoreBundle\Entity\Role", mappedBy="user", cascade="persist")
     **/
    private $roles;

    public function __construct() {
        $this->logged = new \DateTime();
        $this->roles = new ArrayCollection();
    }

    public function setUserId($id) {
        $this->user_id = $id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassRepeat($pass) {
        $this->passRepeat = $pass;
    }

    public function getPassRepeat() {
        return $this->passRepeat;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setRegistered(\DateTime $registered) {
        $this->registered = $registered;
    }

    public function getRegistered() {
        return $this->registered;
    }

    public function setVerified($verified) {
        $this->verified = $verified;
    }

    public function getVerified() {
        return $this->verified;
    }

    public function setLastLogin(\DateTime $lastLogin) {
        $this->lastLogin = $lastLogin;
    }

    public function getLastLogin($lastLogin) {
        return $this->lastLogin;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    public function setVerificationHash($hash) {
        return $this->verificationHash = $hash;
    }

    public function getVerificationHash() {
        return $this->verificationHash;
    }





    public function setRoles(Role $role) {
        $this->roles->add($role);
    }

    public function getRoles() {
        return $this->roles->toArray();
    }

    public function isInRole($roleType) {
        $role = $this->getRoles()[0]->getRole();

        return $roleType === $role;
    }

    public function getSalt() {
        return '8sfd4g68ds4fg98d48mk81';
    }

    public function eraseCredentials() {

    }

    public function serialize()
    {
        return serialize(array(
            $this->user_id,
            $this->username,
            $this->password,
            $this->name,
            $this->lastname,
            $this->registered,
            $this->verified,
            $this->lastLogin,
            $this->isActive
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->user_id,
            $this->username,
            $this->password,
            $this->name,
            $this->lastname,
            $this->registered,
            $this->verified,
            $this->lastLogin,
            $this->isActive
            ) = unserialize($serialized);
    }

    /**
     * @Assert\Callback
     */
    public function validatePasswordEquality(ExecutionContextInterface $context)
    {
        if(strcmp($this->getPassword(), $this->getPassRepeat()) !== 0) {
            $context->buildViolation('Given passwords have to be equal')
                ->atPath('password')
                ->addViolation();
        }
    }
} 