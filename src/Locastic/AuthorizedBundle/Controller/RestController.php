<?php

namespace Locastic\AuthorizedBundle\Controller;


use Locastic\CoreBundle\Repositories\ListRepository;
use Locastic\CoreBundle\Tools\ConvenienceValidator;
use Locastic\CoreBundle\Tools\Factories\DoctrineEntityFactory;
use RCE\Builder\Builder;
use RCE\ContentEval;
use RCE\Filters\BeArray;
use RCE\Filters\BeInteger;
use RCE\Filters\BeString;
use RCE\Filters\Exist;
use RCE\Filters\Mutator;
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
            $response->setContent(json_encode('An error occurred. Please, refresh the page and try again'));
            $response->setStatusCode(400, "BAD");

            return $response;
        }

        /*
         * Creates an entity out of an array
         * */
        $todoList = DoctrineEntityFactory::initiate('List')->with($content)->create();

        /* Validates the entity with symfony validator */
        $toValidate = array($todoList);
        $errors = ConvenienceValidator::init($toValidate, $this->container->get('validator'))->getErrors();

        if($errors !== null) {
            $response = new Response();
            $response->setContent(json_encode($errors['errors']));
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
            $response->setContent(json_encode('An error occurred. Please, refresh the page and try again'));
            $response->setStatusCode(400, "BAD");

            return $response;
        }

        $response = new Response();
        $response->setStatusCode(200, "OK");

        return $response;
    }

    public function addTaskAction() {
        $request = $this->container->get('request');

        $content = json_decode($request->getContent(), true);

        $builder = new Builder($content);
        $builder->build(
            $builder->expr()->hasTo(new Exist('listId'), new BeInteger('listId')),
            $builder->expr()->hasTo(new Exist('name'), new BeString('name')),
            $builder->expr()->hasTo(new Exist('deadline'), new BeArray('deadline'), new Mutator('deadline', function($toMutate) {
                $day = $toMutate['day'];
                $month = $toMutate['month'];
                $year = $toMutate['year'];

                return new \DateTime($year . '-' . $month . '-' . $day);
            })),
            $builder->expr()->hasTo(new Exist('priority'), new BeInteger('priority'))
        );

        if( ! ContentEval::builder($builder)->isValid()) {
            /*
             * If the server receives invalid client data, it rejects the request
             * */
            $response = new Response();
            $response->setContent(json_encode('An error occurred. Please, refresh the page and try again'));
            $response->setStatusCode(400, "BAD");

            return $response;
        }

        $content = $builder->getContent();
        $task = DoctrineEntityFactory::initiate('Task')->with($content)->create();

        /* Validates the entity with symfony validator */
        $toValidate = array($task);
        $errors = ConvenienceValidator::init($toValidate, $this->container->get('validator'))->getErrors();

        if($errors !== null) {
            $response = new Response();
            $response->setContent(json_encode($errors['errors']));
            $response->setStatusCode(400, "BAD");

            return $response;
        }

        try {
            $listRepo = $this->container->get('task_repository');
            $listRepo->addTask($task);
        }
        catch(\Exception $e) {
            /*
              List data could not be saved to the database. Send bad response
            * */
            $response = new Response();
            $response->setContent($e->getMessage());
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