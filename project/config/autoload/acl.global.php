<?php
return array(
    'acl' => array(
        'roles' => array(
            'guest' => null,
            'student' => 'guest',
            'teacher'  => 'student',
            'admin'  => 'teacher',
            'superadmin'  => 'admin',
        ),
        'resources' => array(
            'allow' => array(
				'Practic\Controller\Index' => array(
                    'all' => 'guest',
				),
                'Practic\Controller\Diary' => array(
                    'all' => 'admin',
                ),
                'ZfcDatagrid\Examples\Controller\Person' => array(
                    'all' => 'admin',
                ),
            ),
            'deny' => array(
            ),
        )
    )
);
