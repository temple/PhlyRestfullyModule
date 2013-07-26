<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Orkmodule\Controller\Orkmodule' => 'Orkmodule\Controller\OrkmoduleController',
            'Orkmodule\Controller\Rest' => 'Orkmodule\Controller\RestController',
        ),
    ),
    'router' => include('module.routes.config.php'),
	// The following section is new and should be added to your file	
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
           // 'Orkmodule/Orkmodule/index' => __DIR__ . '/../view/Orkmodule/Orkmodule/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'orkmodule' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
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
