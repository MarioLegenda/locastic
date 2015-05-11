<?php

namespace Locastic\PublicBundle\Controller;


use Symfony\Component\DependencyInjection\ContainerAware;

class PublicController extends ContainerAware
{
    public function unauthorizedAction() {
        $templating = $this->container->get('templating');

        return $templating->renderResponse('LocasticPublicBundle:Public:public.html.twig');
    }
} 