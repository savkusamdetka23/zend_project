<?php

class Application_Model_DbTable_Comments extends Zend_Db_Table_Abstract
{

    protected $_name = 'comments';


	public function getComments($establishment_id)
    {
        $establishment_id = (int) $establishment_id;
        $row = $this->fetchRow('establishment_id = ' . $establishment_id );
        if (! $row) {
            throw new Exception("we don't have record 'id' - $establishment_id");
        }
        return $row->toArray();

    }
    public function getCommentsList($id)
    {

        $select = $this->_db->select()
            ->from('comments',
                array(
                    'comments.id',
                    'comments.establishment_id',
                    'comments.username',
                    'comments.comment',
                    'comments.date'
                ))->where('comments.establishment_id = ?', $id);

        return $this->getAdapter()->fetchAll($select);

    }
    public function getListComments(){
        $select = $this->getAdapter()->select()
            ->from('comments',
                array(
                    'comments.id',
                    'comments.establishment_id',
                    'comments.username',
                    'comments.comment',
                    'comments.date'
                ))
            ->joinLeft(array('establishments'), 'establishments.id = comments.establishment_id', array('establishment' => 'title'));


        return $this->getAdapter()->fetchAll($select);

    }

    public function getCommentToDel($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Cannot find row id");
        }
        return $row->toArray();
    }
    public function addComments($establishment_id, $username, $comment)
    {
        $data = array(
            'establishment_id' => $establishment_id,
            'username' => $username,
            'comment' => $comment,
            'date' => date('Y-m-d H:i:s')
        );
        $this->insert($data);
    }
	 public function updateComment($id, $establishment_id, $username, $comment)
    {
        $data = array(
            'establishment_id' => $establishment_id,
            'username' => $username,
            'comment' => $comment,
            'date' => date('Y-m-d H:i:s')
        );
       	$this->update($data, 'id = '.(int)$id);
    }
    public function deleteComment($id)
    {
        $this->delete('id = ' . (int)$id);
    }

}

