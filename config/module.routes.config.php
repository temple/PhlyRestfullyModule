<?php

function restController($module=null){
    $module = ($module?$module:'orkmodule');
    return "$module\Controller\Rest";
}

function restAction($request,$module,$segment = null, $constraints = null, $action=null){
    $request=strtolower($request);
    $action = ($action ? $action : $request);

    if (!is_null($segment)):
        return array(
            'type' => 'segment',
            'options' => array(
                'route' => "$segment",
                'constraints' => (array) $constraints,                
            ),
            'may_terminate' => false,
            'child_routes' => array(
                "rest/method/$request" => array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => "$request",
                        'defaults' => array(
                            'action' => "$action"
                        )
                    ),
                    "may_terminate" => true,
                )
            )
        );
    else:
        return array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => "$request",
                        'defaults' => array(
                            'action' => "$action"
                        )
                    ),
                    "may_terminate" => true,

                );
    endif;
}




function routeAction($action,$module,$segment=NULL){
    return array(
        'type' => 'segment',
        'options' => array(                
                'verb' => "$action",
                'defaults' => array(
                   // 'controller' => "$module\Controller\Rest",
                    'action' => "$action"
                ),
        ) + (is_null($segment) ? array() : array('route' => "$segment"))        
    );
}

$routes= array(
			'routes' => array(                    
                    'skeleton' => array(
                        'type' => 'Hostname',
                        'options' => array(
                            'route' => 'skeleton',  //cambiar por el dominio
                            'defaults' => array(
                                'controller' => 'application\Controller\Index',
                                'action' => 'index',
                            )
                        ), 


                        'child_routes' => array(
                            'rest' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route' =>'/rest',
                                    'defaults' => array(
                                        'controller' => 'orkmodule\Controller\Rest',
                                        'action' => 'index',
                                        'entity' => 'all'
                                    )
                                ),
                                'may_terminate' => true,
                                'child_routes' => ($child_routes = array(                                                                        
                                    'rest/entity' => array(
                                        'type' => 'segment',
                                        'options' => array(
                                            'route' => '/:entity',
                                            'constraints' => array(
                                                'entity' => '[a-zA-Z][a-zA-Z0-9_]*',
                                            ),
                                            'defaults' => array(
                                                'action' => 'index',
                                            )
                                        ),
                                        "may_terminate" => true,
                                        'child_routes' => array(                                            
                                            'rest/get' => restAction('get','orkmodule','/:id',array('id'=>'[0-9]+')),
                                            'rest/delete' => restAction('delete','orkmodule','/:id',array('id'=>'[0-9]+')),
                                            'rest/put' => restAction('put','orkmodule','/:id',array('id'=>'[0-9]+')),
                                            'rest/post' => restAction('post','orkmodule'),
                                        )
                                    ),
                                    'rest/action' => array(
                                        'type' => 'segment',
                                        'options' => array(
                                            'route' => '/:action',
                                            'constraints' => array(
                                                'action' => '(get|read|post|create|put|update|delete)',
                                            ),                                            
                                            'defaults' => array(
                                                'entity' => 'all'
                                            )
                                        ),
                                        'may_terminate' => true,
                                        'child_routes' => array(
                                            'rest/action/entity' => array(
                                                'type' => 'segment',
                                                'options' => array(
                                                    'route' => '/:entity',
                                                    'constraints' => array(
                                                        'entity' => '[a-zA-Z][a-zA-Z0-9_]*',
                                                    ),                                                
                                                ),
                                                "may_terminate" => true,
                                                'child_routes' => array(
                                                    'rest/action/entity/id' => array(
                                                        'type' => 'segment',
                                                        'options' => array(
                                                            'route' => '/:id',
                                                            'constraints' => array(
                                                                'id' => '[0-9]+',
                                                                'action' => '(get|read|put|update|delete)'
                                                            )
                                                        )
                                                    )
                                                )
                                            )
                                        )
                                    ),                                   
                                ))                                
                            )
                        ),
                    ),
                    'rest.skeleton' => array(
                        'type' => 'Hostname',
                        'options' => array(
                            'route' => ':subdomain.skeleton',
                            'constraints' => array(
                                'subdomain' => 'rest'
                            ),
                            'defaults' => array(
                                'controller' => restController('orkmodule'),
                                'action' => 'index',
                            )
                        ),
                        'may_terminate' => 'true',
                        'child_routes' => $child_routes                           
                    ),


            )
        );


//print"<pre>".print_r($routes,true)."</pre>";
return $routes;