<?php

namespace Locastic\PublicBundle\Controller;


use Symfony\Component\DependencyInjection\ContainerAware;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContextInterface;

class LoginController extends ContainerAware
{
    public function loginAction() {
        $templating = $this->container->get('templating');

        /*$options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        var_dump(password_hash('sashapopara', PASSWORD_BCRYPT, $options));
die();*/


        $request = $this->container->get('request');

        $session = $request->getSession();

        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        $flashBag = $this->container->get('session')->getFlashBag();
        return $templating->renderResponse(
            'LocasticPublicBundle:Login:login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
                'verificationNotice' => ($flashBag->has('verification_notice')) ? $flashBag->get('verification_notice')[0] : null
            )
        );
    }

    public function emailVerificationAction($hash) {
        $this->container->get('doctrine');
        $userRepo = $this->container->get('user_repository');

        /*
         * Check if the user with $hash exists
         * */
        $user = $userRepo->verifyUser($hash);
        $router = $this->container->get('router');

        /*
         * If the user does not exist, redirect to login page with error message
         * */
        $flashBag = $this->container->get('session')->getFlashBag();
        if( $user === false) {
            $flashBag->add('verification_notice', 'Before you can login, you have to verify your registration. Check the provided email');

            return new RedirectResponse($router->generate('login'));
        }

        /*$token = new UsernamePasswordToken($user, null, 'secured_area', $user->getRoles());
        $this->container->get('security.context')->setToken($token);
        $this->container->get('session')->set('secured_area', serialize($token));*/


        /* Account has been verified and user is prompted with the message to login */
        $flashBag->add('verification_notice', 'Your account has been verified. Please, login with your username and password');
        return new RedirectResponse($router->generate('login'));
    }
} 