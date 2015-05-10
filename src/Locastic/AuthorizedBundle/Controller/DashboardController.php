<?php

namespace Locastic\AuthorizedBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DashboardController extends ContainerAware
{
    public function dashboardAction() {
        $securityContext = $this->container->get('security.context');
        if ( ! $securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $router = $this->container->get('router');

            return new RedirectResponse($router->generate('locastic_public_unauthorized'));
        }

        $templating = $this->container->get('templating');

        return $templating->renderResponse('LocasticAuthorizedBundle:Dashboard:dashboard.html.twig');
    }
} 