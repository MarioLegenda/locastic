<?php

namespace Locastic\PublicBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class InitialController extends ContainerAware
{
    public function initAction() {
        $templating = $this->container->get('templating');

        return $templating->renderResponse('LocasticPublicBundle:Initial:initial.html.twig');
    }
} 