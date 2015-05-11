<?php

namespace Locastic\PublicBundle\Listeners;

use Locastic\CoreBundle\Repositories\UserRepository;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class AuthListener
{
    private $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function onAuthenticationSuccess( InteractiveLoginEvent $event ) {
        $this->userRepo->refreshLoggedIn($event->getAuthenticationToken()->getUser());
    }
} 