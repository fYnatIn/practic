<?php
return array(
	'controllers' => array(
        'invokables' => array(
            'Practic\Controller\Index' => 'Practic\Controller\IndexController',
            'Practic\Controller\Diary' => 'Practic\Controller\DiaryController',
        ),
	),
    'router' => array(
        'routes' => array(
            'auth' => array(
				'type' => 'segment',
				'options' => array(
					'route' => '/auth[/][:action]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'Practic\Controller\Index',
						'action' => 'index',
					),
				),
			),
            'diary' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/diary[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Practic\Controller\Diary',
                        'action' => 'index',
                    ),
                ),
            ),
		),
	),
    'view_manager' => array(
        'template_path_stack' => array(
            'account' => __DIR__ . '/../view'
        ),
		
		'display_exceptions' => true,
    ),
	'service_manager' => array(
		'aliases' => array(
			'Zend\Authentication\AuthenticationService' => 'my_auth_service',
		),
		'invokables' => array(
			'my_auth_service' => 'Zend\Authentication\AuthenticationService',
		),
	),
);