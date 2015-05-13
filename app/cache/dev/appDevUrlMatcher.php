<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

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
