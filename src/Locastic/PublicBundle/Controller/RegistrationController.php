<?php

namespace Locastic\PublicBundle\Controller;

use Locastic\CoreBundle\Entity\User;
use Locastic\CoreBundle\Forms\UserType;
use Locastic\CoreBundle\Tools\VerificationHash;
use Symfony\Component\DependencyInjection\ContainerAware;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

class RegistrationController extends ContainerAware
{
    public function registrationAction() {
        $templating = $this->container->get('templating');
        $request = $this->container->get('request');

        $user = new User();
        $userType = new UserType();
        $form = $this->container->get('form.factory')->create($userType, $user);

        $cache = $this->container->get('cache');

        $form->handleRequest($request);

        if ($form->isValid()) {
            $userRepo = $this->container->get('user_repository');

            $existingUser = $userRepo->getUserByUsername($user->getUsername());

            // checks if user exists
            if($existingUser === false) {
                // creates a user and user verification hash
                $verificationHash = new VerificationHash($this->container->get('cache'));
                $userRepo->createUser($user, $verificationHash);
            }
        }

        return $templating->renderResponse('LocasticPublicBundle:Registration:registration.html.twig', array(
            'form' => $form->createView()
        ));
    }
} 