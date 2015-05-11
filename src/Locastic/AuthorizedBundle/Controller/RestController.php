<?php

namespace Locastic\AuthorizedBundle\Controller;


use Locastic\CoreBundle\Repositories\ListRepository;
use RCE\Builder\Builder;
use RCE\ContentEval;
use RCE\Filters\BeString;
use RCE\Filters\Exist;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;

class RestController extends ContainerAware
{
    public function getListsAction() {
        $request = $this->container->get('request');

        $content = json_decode($request->getContent(), true);

        $builder = new Builder($content);
        $builder->build(
            $builder->expr()->hasTo(new Exist('order'), new BeString('order')),
            $builder->expr()->hasTo(new Exist('type'), new BeString('type'))
        );

        if( ! ContentEval::builder($builder)->isValid()) {
            /*
             * If the server receives invalid client data, it rejects the request
             * */
            $response = new Response();
            $response->setContent('An error occurred. Please, refresh the page and try again');
            $response->setStatusCode(400, "BAD");

            return $response;
        }

        try {
            $listRepo = $this->container->get('order_repository');
            $result = $listRepo->getLists($content['order'], $content['type']);
        }
        catch(\Exception $e) {
            /*
              List data could not be saved to the database. Send 400 response
            * */
            $response = new Response();
            $response->setContent($e->getMessage());
            $response->setStatusCode(400, "BAD");

            return $response;
        }

        $lists['lists'] = $result;
        $response = new Response();
        $response->setContent(json_encode($lists));
        $response->setStatusCode(200, "OK");
        return $response;
    }

    public function addListAction() {
        $request = $this->container->get('request');

        $content = json_decode($request->getContent(), true);

        $builder = new Builder($content);
        $builder->build(
            $builder->expr()->hasTo(new Exist('name'), new BeString('name'))
        );

        if( ! ContentEval::builder($builder)->isValid()) {
            /*
             * If the server receives invalid client data, it rejects the request
             * */
            $response = new Response();
            $response->setContent('An error occurred. Please, refresh the page and try again');
            $response->setStatusCode(400, "BAD");

            return $response;
        }

        try {
            $listRepo = $this->container->get('list_repository');
            $user = $this->container->get('security.context')->getToken()->getUser();
            $listRepo->createList($content, $user);
        }
        catch(\Exception $e) {
            /*
              List data could not be saved to the database. Send bad response
            * */
            $response = new Response();
            $response->setContent('An error occurred. Please, refresh the page and try again');
            $response->setStatusCode(400, "BAD");

            return $response;
        }

        $response = new Response();
        $response->setStatusCode(200, "OK");

        return $response;
    }

    public function deleteListAction() {

    }
} 