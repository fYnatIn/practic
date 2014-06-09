<?php
namespace Practic\Form;

use Zend\Form\Form;

class AuthForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('practic');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'u_login',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Username',
            ),
        ));
        $this->add(array(
            'name' => 'u_pwd',
            'attributes' => array(
                'type'  => 'password',
            ),
            'options' => array(
                'label' => 'Password',
            ),
        ));		
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        )); 
    }
}