<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Album\Controller\Album' => 'Album\Controller\AlbumController',
        ),
    ),
	// The following section is new and should be added to your file
	'router' => array(
			'routes' => array(
					'album' => array(
							'type'    => 'segment',
							'options' => array(
									'route'    => '/album[/:action][/:id]',
									'constraints' => array(
											'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
											'id'     => '[0-9]+',
									),
									'defaults' => array(
											'controller' => 'Album\Controller\Album',
											'action'     => 'index',
									),
							),
					),
			),
	),	
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
           // 'album/album/index' => __DIR__ . '/../view/album/album/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),    
    'translator' => array(
        'locale' => 'es_ES',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
    /*        'translator' 
                => 'Zend\I18n\Translator\TranslatorServiceFactory',*/
            )
        ),
);
