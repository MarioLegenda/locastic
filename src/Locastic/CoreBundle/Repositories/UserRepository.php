<?php

namespace Locastic\CoreBundle\Repositories;


use Doctrine\ORM\Query;
use Locastic\CoreBundle\Entity\Role;
use Locastic\CoreBundle\Entity\User;
use Locastic\CoreBundle\Tools\VerificationHash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserRepository extends Repository
{
    public function getUserByUsername($username) {
        $qb = $this->manager->createQueryBuilder();

        $user = $qb->select(array('u'))
            ->from('LocasticCoreBundle:User', 'u')
            ->where($qb->expr()->eq('u.username', ':username'))
            ->setParameter(':username', $username)
            ->getQuery()
            ->getResult();

        if(empty($user)) {
            return null;
        }

        return $user[0];
    }

    public function createUser(User $user, VerificationHash $verHash, $encoder) {
        $hash = $verHash->createHash()->getHash();

        $role = new Role();
        $role->setRole('ROLE_USER');
        $role->setUser($user);
        $user->setRoles($role);

        $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
        $user->setVerificationHash($hash);
        $user->setIsActive(0);
        $user->setLastLogin(new \DateTime());
        $user->setRegistered(new \DateTime());
        $user->setVerified(0);

        $this->manager->persist($user);
        $this->manager->flush();
    }

    public function verifyUser($hash) {
        $qb = $this->manager->createQueryBuilder();

        $user = $qb->select(array('u'))
            ->from('LocasticCoreBundle:User', 'u')
            ->where($qb->expr()->eq('u.verificationHash', ':hash'))
            ->setParameter(':hash', $hash)
            ->getQuery()
            ->getResult();

        if(empty($user)) {
            return false;
        }

        $user[0]->setVerified(1);
        $this->manager->persist($user[0]);
        $this->manager->flush();

        return $user[0];
    }

    /**
     * @param User $user
     *
     * User provided from Locastic\PublicBundle\Listeners\AuthListener
     */
    public function refreshLoggedIn(User $user) {
        $user->setLastLogin(new \DateTime());

        $this->manager->persist($user);
        $this->manager->flush();
    }
} 