<?php

function restAction($request,$module,$action=null){
    $request=strtolower($request);
    $action = ($action ? $action : $request);
    return array(
        'type' => 'method',
        'options' => array(
                'route' => '/rest[/:id]',
                'verb' => "$request",
                'defaults' => array(
                    'controller' => "$module\Controller\Rest",
                    'action' => "$action"
                ),
        ),
    );
}

return 	array(
			'routes' => array(
					'orkmodule' => array(
							'type'    => 'segment',
							'options' => array(
									'route'    => '/orkmodule[/:action][/:id]',
									'constraints' => array(
											'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
											'id'     => '[0-9]+',
									),
									'defaults' => array(
											'controller' => 'orkmodule\Controller\Orkmodule',
											'action'     => 'index',
									),
							),
					),
					'rest/get'=> restAction('get','orkmodule'),
					'rest/post'=> restAction('post','orkmodule'),
                    'rest/delete'=> restAction('delete','orkmodule'),
                    'rest/put'=> restAction('put','orkmodule','update'),
                    
					/*
                    'orkmodule/rest' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/orkmodule/rest',
                            'defaults' => array(
                                'controller' => 'orkmodule\Controller\Rest',
                                'action' => 'index'
                            )
                            
                        ),
                        'may_terminate' => 'true',
                        'child_routes' => array(
                            'default' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[/:id]',
                                    'constraints' => array(
                                        'action' => '[0-9]+'
                                    )
                                )
                            )
                        )
                    ),
                    'orkmodule/tser' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/orkmodule/tser',
                            'defaults' => array(
                                'controller' => 'orkmodule\Controller\Rest',
                                'action' => 'index'
                            )
                            
                        ),
                        'may_terminate' => 'true',
                        'child_routes' => array(
                            'default' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[/:id]',
                                    'constraints' => array(
                                        'action' => '[0-9]+'
                                    )
                                )
                            )
                        )
                    )*/
			),
		);