<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Paste\PasteController' => 'Paste\Controller\PasteController',
            'Paste\ApiController' => 'Paste\Controller\ApiController',
        ),
    ),
	// The following section is new and should be added to your file
	'router' => array(
			'routes' => array(
                    'paste' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/paste',
                            'controller' => 'Paste\PasteController', // for the web UI
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'api' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route'      => '/api/pastes[/:id]',
                                    'controller' => 'Paste\ApiController',
                                ),
                            ),
                        ),
                    ),					
			),
	),
    'phlyrestfully' => array(
        'resources' => array(
            'Paste\ApiController' => array(
                'identifier'              => 'Pastes',
                'listener'                => 'Paste\PasteResourceListener',
                'resource_identifiers'    => array('PasteResource'),
                'collection_http_options' => array('get', 'post'),
                'collection_name'         => 'pastes',
                'page_size'               => 10,
                'resource_http_options'   => array('get'),
                'route_name'              => 'paste/api',
            ),
        ),
    ),
);
