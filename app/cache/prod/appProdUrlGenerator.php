<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * appProdUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes = array(
        'locastic_dashboard' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\DashboardController::dashboardAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'locastic_addList' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::addListAction',  ),  2 =>   array (    '_method' => 'POST',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/list-managment/add-list',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'locastic_deleteList' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::deleteListAction',  ),  2 =>   array (    '_method' => 'POST',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/list-managment/delete-list',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'locastic_getLists' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::getItemsAction',  ),  2 =>   array (    '_method' => 'POST',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/list-managment/get-items',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'locastic_addTask' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::addTaskAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/task-managment/add-task',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'locastic_getTasks' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::getItemsAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/task-managment/get-task',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'locastic_deleteTask' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::deleteTaskAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/task-managment/delete-task',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'locastic_modifyTask' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::modifyTaskAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/task-managment/modify-task',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'locastic_core_homepage' => array (  0 =>   array (    0 => 'name',  ),  1 =>   array (    '_controller' => 'LocasticCoreBundle:Default:index',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'name',    ),    1 =>     array (      0 => 'text',      1 => '/hello',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'locastic_public_unauthorized' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Locastic\\PublicBundle\\Controller\\PublicController::unauthorizedAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/unauthorized',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'locastic_public_registration' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Locastic\\PublicBundle\\Controller\\RegistrationController::registrationAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/registration',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'locastic_public_verification' => array (  0 =>   array (    0 => 'hash',  ),  1 =>   array (    '_controller' => 'Locastic\\PublicBundle\\Controller\\LoginController::emailVerificationAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'hash',    ),    1 =>     array (      0 => 'text',      1 => '/verification',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'login' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Locastic\\PublicBundle\\Controller\\LoginController::loginAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/login',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'login_check' => array (  0 =>   array (  ),  1 =>   array (  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/login_check',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'logout' => array (  0 =>   array (  ),  1 =>   array (  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/logout',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
