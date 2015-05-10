<?php

namespace Locastic\CoreBundle\Repositories;


use Locastic\CoreBundle\Entity\User;
use Locastic\CoreBundle\Tools\VerificationHash;

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
            return false;
        }

        return $user;
    }

    public function createUser(User $user, VerificationHash $verHash) {
        $hash = $verHash->createHash()->getHash();
    }
} 