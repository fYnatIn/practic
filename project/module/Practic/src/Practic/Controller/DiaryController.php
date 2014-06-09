<?php
namespace Practic\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZfcDatagrid\Column;

class DiaryController extends AbstractActionController
{
    private function getDiaryGrid(){
        /* @var $grid \ZfcDatagrid\Datagrid */
        $grid = $this->getServiceLocator()->get('ZfcDatagrid\Datagrid');
        $grid->setTitle('Щоденники');
        $grid->setDefaultItemsPerPage(10);
        $grid->setDataSource($this->getServiceLocator()
            ->get('zfcDatagrid.examples.data.phpArray')
            ->getPersons());

        $col = new Column\Select('id');
        $col->setIdentity();
        $col->setLabel('Id');
        $col->setUserFilterDisabled();
        $col->setSortDefault(1, 'DESC');
        $grid->addColumn($col);

        $col = new Column\Select('pib');
        $col->setLabel('ПІБ');
        $col->setWidth(20);
        $grid->addColumn($col);

        $col = new Column\Select('birthday');
        $col->setLabel('Дата народження');
        $col->setWidth(10);
        $col->setType(new \ZfcDatagrid\Column\Type\DateTime());
        $grid->addColumn($col);

        $col = new Column\Select('teacher');
        $col->setLabel('Керівник');
        $col->setWidth('20');
        $grid->addColumn($col);

        $col = new Column\Select('active');
        $col->setLabel('Активний');
        $col->setWidth(10);
        $col->setReplaceValues(array(
            '1' => 'Активний',
            '0' => 'Неактивний'
        ));
        $col->setTranslationEnabled(true);
        $grid->addColumn($col);

        $action = new Column\Action\Button();
        $action->setLabel('Робота зі щоденником');
        $action->setAttribute('href', 'id/' . $action->getRowIdPlaceholder());

        $col = new Column\Action();
        $col->setLabel('');
        $col->setWidth(10);
        $col->addAction($action);
        $grid->addColumn($col);

        $grid->setRowClickAction($action);

        return $grid;
    }

    public function indexAction(){
        $grid = $this->getDiaryGrid();

        $grid->render();

        return $grid->getResponse();
    }

    public function addAction(){

    }

    public function editAction(){

    }

    public function deleteAction(){

    }
}