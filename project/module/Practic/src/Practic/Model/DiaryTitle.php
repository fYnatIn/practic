<?php
namespace Practic\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class DiaryTitle implements InputFilterAwareInterface
{
    public $id;
    public $group;
    public $student;
    public $department;
    public $teacher;
    public $dateBegin;
    public $dateEnd;

    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->group = (!empty($data['group'])) ? $data['group'] : null;
        $this->student = (!empty($data['student'])) ? $data['student'] : null;
        $this->department = (!empty($data['department'])) ? $data['department'] : null;
        $this->teacher = (!empty($data['teacher'])) ? $data['teacher'] : null;
        $this->dateBegin = (!empty($data['dateBegin'])) ? $data['dateBegin'] : null;
        $this->dateEnd = (!empty($data['dateEnd'])) ? $data['dateEnd'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }


    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $inputFilter->add(array(
                'name' => 'id',
                'required' => false,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'group',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'student',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'department',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'teacher',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'dateBegin',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'pattern' => '(\d{4})-(\d{2})-(\d{2})',
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'dateEnd',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'pattern' => '(\d{4})-(\d{2})-(\d{2})',
                    ),
                ),
            ));
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}