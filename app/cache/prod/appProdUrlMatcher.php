<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // locastic_dashboard
        if (rtrim($pathinfo, '/') === '') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_locastic_dashboard;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'locastic_dashboard');
            }

            return array (  '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\DashboardController::dashboardAction',  '_route' => 'locastic_dashboard',);
        }
        not_locastic_dashboard:

        if (0 === strpos($pathinfo, '/list-managment')) {
            // locastic_addList
            if ($pathinfo === '/list-managment/add-list') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_locastic_addList;
                }

                return array (  '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::addListAction',  '_route' => 'locastic_addList',);
            }
            not_locastic_addList:

            // locastic_deleteList
            if ($pathinfo === '/list-managment/delete-list') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_locastic_deleteList;
                }

                return array (  '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::deleteListAction',  '_route' => 'locastic_deleteList',);
            }
            not_locastic_deleteList:

            // locastic_getLists
            if ($pathinfo === '/list-managment/get-items') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_locastic_getLists;
                }

                return array (  '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::getItemsAction',  '_route' => 'locastic_getLists',);
            }
            not_locastic_getLists:

        }

        if (0 === strpos($pathinfo, '/task-managment')) {
            // locastic_addTask
            if ($pathinfo === '/task-managment/add-task') {
                return array (  '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::addTaskAction',  '_route' => 'locastic_addTask',);
            }

            // locastic_getTasks
            if ($pathinfo === '/task-managment/get-task') {
                return array (  '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::getItemsAction',  '_route' => 'locastic_getTasks',);
            }

            // locastic_deleteTask
            if ($pathinfo === '/task-managment/delete-task') {
                return array (  '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::deleteTaskAction',  '_route' => 'locastic_deleteTask',);
            }

            // locastic_modifyTask
            if ($pathinfo === '/task-managment/modify-task') {
                return array (  '_controller' => 'Locastic\\AuthorizedBundle\\Controller\\RestController::modifyTaskAction',  '_route' => 'locastic_modifyTask',);
            }

        }

        // locastic_core_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'locastic_core_homepage')), array (  '_controller' => 'LocasticCoreBundle:Default:index',));
        }

        // locastic_public_unauthorized
        if ($pathinfo === '/unauthorized') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_locastic_public_unauthorized;
            }

            return array (  '_controller' => 'Locastic\\PublicBundle\\Controller\\PublicController::unauthorizedAction',  '_route' => 'locastic_public_unauthorized',);
        }
        not_locastic_public_unauthorized:

        // locastic_public_registration
        if ($pathinfo === '/registration') {
            return array (  '_controller' => 'Locastic\\PublicBundle\\Controller\\RegistrationController::registrationAction',  '_route' => 'locastic_public_registration',);
        }

        // locastic_public_verification
        if (0 === strpos($pathinfo, '/verification') && preg_match('#^/verification/(?P<hash>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'locastic_public_verification')), array (  '_controller' => 'Locastic\\PublicBundle\\Controller\\LoginController::emailVerificationAction',));
        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'Locastic\\PublicBundle\\Controller\\LoginController::loginAction',  '_route' => 'login',);
                }

                // login_check
                if ($pathinfo === '/login_check') {
                    return array('_route' => 'login_check');
                }

            }

            // logout
            if ($pathinfo === '/logout') {
                return array('_route' => 'logout');
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
