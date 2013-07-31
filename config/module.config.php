<?php

use PhlyRestfully\ResourceController;

return array(
    'controllers' => array(
        'aliases' => array(
            'Paste\PasteController' => 'Paste\Controller\PasteController',
            'Paste\ApiController' => 'Paste\Controller\ApiController',
        ),
    ),
	// The following section is new and should be added to your file
	'router' => array(
			'routes' => array(
                    'paste' => array(
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                            'route' => '/paste',
                            'defaults' => array(
                                'controller' => 'Paste\PasteController', // for the web UI    
                                //'action' => 'index'
                            
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'api' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route'      => '/api/pastes[/:id]',
                                    'defaults' => array(
                                        'controller' => 'Paste\ApiController',
                                    )
                                ),
                            ),
                        ),
                    ),					
			),
	),
    'phlyrestfully' => array(
        'resources' => array(
            'Paste\ApiController' => array(
                'controller_class' => 'Paste\Controller\ApiController',
                'identifier'              => 'Pastes',
                'listener'                => 'Paste\PasteResourceListener',
                'resource_identifiers'    => array('PasteResource'),
                'accept_criteria' => array(
                    'PhlyRestfully\View\RestfulJsonModel' => array(
                        'application/json',
                        'text/json',
                        'application/hal+json',
                        'text/html'
                    ),
                ),
                'content_type' => array(
                    ResourceController::CONTENT_TYPE_JSON => array(
                        'application/json',
                        'application/hal+json',
                        'text/json',
                    ),
                ),


                'collection_http_options' => array('get', 'post'),
                'collection_name'         => 'pastes',
                'page_size'               => 10,
                'resource_http_options'   => array('get','patch','put'),
                'route_name'              => 'paste/api',
            ),
        ),
    ),
);
