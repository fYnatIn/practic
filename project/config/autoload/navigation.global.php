<?php
return array(
     'navigation' => array(
         'default' => array(
             array(
                 'label' => 'Home',
                 'route' => 'home',
             ),
             array(
                 'label' => 'Diary',
                 'route' => 'diary',
                 'action'     => 'index',
                 'controller' => 'Diary',
                 'resource'	=> 'Practic\Controller\Diary',
                 'privilege'	=> 'index',
             ),
         ),
     ),
     'service_manager' => array(
         'factories' => array(
             'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
         ),
     ),
);