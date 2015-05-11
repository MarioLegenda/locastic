<?php

namespace Locastic\PublicBundle\Listeners;


use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthenticationListener
{
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event) {
        $request = $event->getRequest();

        $controller = $request->attributes->get('_controller');

        $invalidControllers = array(
            'Locastic\PublicBundle\Controller\LoginController::loginAction',
            'Locastic\PublicBundle\Controller\RegistrationController::registrationAction',
        );

        if(in_array($controller, $invalidControllers) === true) {
            $securityContext = $this->container->get('security.context');
            if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
                $router = $this->container->get('router');

                $response = new RedirectResponse($router->generate('locastic_dashboard'));
                $event->setResponse($response);
            }
        }
    }
}