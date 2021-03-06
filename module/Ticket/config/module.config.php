<?php
namespace Ticket;

return array(
    'router' => array(
        'routes' => array(
            'adm' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/adm',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Ticket\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:id[/:active]]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '\d+',
                                'active'         => '\d+',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    )
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Ticket\Controller\Index' => 'Ticket\Controller\IndexController',
            'Ticket\Controller\Teste' => 'Ticket\Controller\TesteController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/ticket.phtml',
            'ticket/index/index' =>    __DIR__ . '/../view/ticket/index/index.phtml',
            'ticket/categoria/index' =>    __DIR__ . '/../view/ticket/categoria/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        
        
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'TpMinify' => array(
        'serveOptions' => array(
            'minApp' => array(
                'groups' => array(
                    'ticket-css' => array(
                        getcwd() . '/public/libs/bootstrap/dist/css/bootstrap.min.css',
                        getcwd() . '/public/libs/fontawesome/css/font-awesome.min.css',
                        getcwd() . '/public/css/styles.css',
                    ),
                    'ticket-js' => array(
                        getcwd() . '/public/libs/jquery/dist/jquery.min.js',
                        getcwd() . '/public/libs/bootstrap/dist/js/bootstrap.min.js',
                        getcwd() . '/public/js/homer.js',
                        getcwd() . '/public/js/scripts.js'
                    )
                )
            )
        ),
    ),
);
