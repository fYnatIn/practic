<?php
namespace Practic\Model;

use Zend\Db\TableGateway\TableGateway;

class DiaryTitleTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getDiaryTitle($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveDiaryTitle(DiaryTitle $diaryTitle)
    {
        $data = array(
            'group' => $diaryTitle->group,
            'student' => $diaryTitle->student,
            'department' => $diaryTitle->department,
            'teacher' => $diaryTitle->teacher,
            'date_begin' => $diaryTitle->dateBegin,
            'date_end' => $diaryTitle->dateEnd,
        );

        $id = (int)$diaryTitle->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getDiaryTitle($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
}