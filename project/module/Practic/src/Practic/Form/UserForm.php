<?php
namespace Account\Form;

use Zend\Form\Form;

class UserForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('registration');
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'role',
			'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Role',
				'value_options' => array(
					'1' => 'User',
					'2' => 'Employee',
					'3' => 'Admin',
				),
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