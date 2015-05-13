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

        $form->handleRequest($request);

        if ($form->isValid()) {
            $userRepo = $this->container->get('user_repository');

            $existingUser = $userRepo->getUserByUsername($user->getUsername());

            // checks if user exists
            if($existingUser === null) {

                /*
                 * VerificationHash -> object that creates the hash and checks if the created has already
                 * exists
                 * */
                $verificationHash = new VerificationHash($this->container->get('cache'));
                $userRepo->createUser($user, $verificationHash, $this->container->get('security.password_encoder'));

                $flashBag = $this->container->get('session')->getFlashBag();
                $router = $this->container->get('router');

                /*
                 * Notice that is displayed in the login page after user registrates
                 */
                $flashBag->add('verification_notice', 'Before you can login, you have to verify your registration. Check the provided email');

                $mailer = $this->container->get('mailer');
                $message = $mailer->createMessage()
                    ->setSubject('Task Manager registration confirmation')
                    ->setFrom('assotmn@gmail.com')
                    ->setTo($user->getUsername())
                    ->setBody($templating->render('::email.html.twig', array(
                        'link' => $router->generate('locastic_public_verification', array('hash' => $user->getVerificationHash()), true)
                    )), 'text/html');

                $status = $mailer->send($message);

                if($status === false) {
                    throw new \Exception("Email could not be sent");
                }

                /* If the user is created successfully, login page is displayed */
                return new RedirectResponse("login");
            }

            /* If the user exists, an error is displayed in the registration form */
            return $templating->renderResponse('LocasticPublicBundle:Registration:registration.html.twig', array(
                'form' => $form->createView(),
                'user_exists' => $existingUser->getUsername()
            ));
        }

        // default view for registration
        return $templating->renderResponse('LocasticPublicBundle:Registration:registration.html.twig', array(
            'form' => $form->createView()
        ));
    }
} 