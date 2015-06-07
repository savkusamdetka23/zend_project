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







    public function getListAddresses(){
        /*	$select = $this->getAdapter()->select()->from(array('establishments', 'establishments.id', 'establishments.address_id'))->join(array('addresses', 'addresses.id=establishments.address_id')->where('street');

            return $this->getAdapter()->fetchAll($select);*/
        /*$select =  $this->getAdapter()->select()->from($this)->join('addresses', 'addresses.id = establishments.address_id')->where('street = ?',$street);
        return $this->fetchAll($select);
    */
        $select = $this->_db->select()
            ->from($this->_name,
                array('key' => 'id', 'value' => 'street'));
        $result = $this->getAdapter()->fetchAll($select);
        return $result;
    }

    public function getAddressesToDel($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Cannot find row id");
        }
        return $row->toArray();
    }
    public function addComments($username, $comment)
    {
        $data = array(
            'username' => $username,
            'comment' => $comment,
            'date' => date('Y-m-d H:i:s')
        );
        $this->insert($data);
    }
	 public function updateAddresses($id, $city, $street)
    {
        $data = array(
			'id' => $id,
			'city' => $city,
            'street' => $street
        );
       	$this->update($data, 'id = '.(int)$id);
    }
    public function deleteAddresses($id)
    {
        $this->delete('id = ' . (int)$id);
    }
    public function searchInTable($search_what)
    {
        $data = $this->select()
            ->from($this->_name)
            ->where("addresses LIKE '%$search_what%'");
        return $data->query()->fetchAll();
    }

}

