<?php

class Application_Model_DbTable_Establishmenttype extends Zend_Db_Table_Abstract
{

    protected $_name = 'establishmenttype';
	public function getEstablishmenttype($id)
    {      
        $id = (int)$id;

      
        $row = $this->fetchRow('id = ' . $id);
        if(!$row) {
            throw new Exception("There is no record with id - $id");
        }
          return $row->toArray();
    }
    public function getEstablishmenttypeList()
    {
        $select = $this->getAdapter()->select()
            ->from('establishmenttype',
                array(
                    'establishmenttype.id',
                    'establishmenttype.type',
                    'establishmenttype.establishment'
                ));

        return $this->getAdapter()->fetchAll($select);
    }

    public function getListEstablishmenttype(){
        /*	$select = $this->getAdapter()->select()->from(array('establishments', 'establishments.id', 'establishments.address_id'))->join(array('addresses', 'addresses.id=establishments.address_id')->where('street');

            return $this->getAdapter()->fetchAll($select);*/
        /*$select =  $this->getAdapter()->select()->from($this)->join('addresses', 'addresses.id = establishments.address_id')->where('street = ?',$street);
        return $this->fetchAll($select);
    */
        $select = $this->_db->select()
            ->from($this->_name,
                array('key' => 'id', 'value' => 'establishment'));
        $result = $this->getAdapter()->fetchAll($select);
        return $result;
    }

    public function getEstablishmenttypeToDel($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Cannot find row id");
        }
        return $row->toArray();
    }
    public function addEstablishmenttype($type, $establishment)
    {
        $data = array(
            'type' => $type,
            'establishment' => $establishment,
        );
        $this->insert($data);
    }
	 public function updateEstablishmenttype($id, $type, $establishment)
    {
        $data = array(
			'type' => $type,
            'establishment' => $establishment,
        );
       	$this->update($data, 'id = '.(int)$id);
    }
    public function deleteEstablishmenttype($id)
    {
        $this->delete('id = ' . (int)$id);
    }
    public function searchInTable($search_what)
    {
        $data = $this->select()
            ->from($this->_name)
            ->where("establishment LIKE '%$search_what%'");
        return $data->query()->fetchAll();
    }

}

