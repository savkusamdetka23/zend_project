<?php

class Application_Model_DbTable_Establishments extends Zend_Db_Table_Abstract
{

    protected $_name = 'establishments';
	public function getEstablishments($id)
    {
        $id = (int)$id;
		$row = $this->fetchRow('id = ' . $id);

        if(!$row) {
            throw new Exception("There is no record with id - $id");
        }
        return $row->toArray();
    }

	public function getAddress()
    {
	/*	$addresses = new Application_Model_DbTable_Addresses();
		$addresses_id = $addresses->getAddresses($street);*//*
        $select =  $this->getAdapter()->select()->from($this)->join('street', 'establishments.address_id = addresses.id')->where('street = ?',$street);
    return $this->fetchAll($select);*/
    }
	
	
    public function getEstablishmentsListForSearch()
    {
        $select = $this->_db->select()
						->from($this->_name,
                array('key' => 'title', 'value' => 'title'));
        $result = $this->getAdapter()->fetchAll($select);
        return $result;
    }
    public function getEstablishmentsToDel($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Cannot find row id");
        }
        return $row->toArray();
    }
    public function addEstablishments($title, $address_id, $gps, $telephone, $description/*, $id_work_time, $description, $id_establishment_type*/)
    {
        $data = array(
            'title' => $title,
            'address_id' => $address_id,
			'gps' => $gps,
            'telephone' => $telephone,
			 'description' => $description,
			/*'id_work_time' => $id_work_time,
            'description' => $description,
			'id_establishment_type' => $id_establishment_type,*/
            );
        $this->insert($data);
    }
	 public function updateEstablishments($id, $title, $address_id, $gps, $telephone, $description)
    {
        $data = array(
			 'title' => $title,
            'address_id' => $address_id,
			'gps' => $gps,
			'telephone' => $telephone,
			'description' => $description,
        );
       	$this->update($data, 'id = '.(int)$id);
    }
    public function deleteEstablishments($id)
    {
        $this->delete('id = ' . (int)$id);
    }
    public function searchInTable($search_what)
    {
        $data = $this->select()
            ->from($this->_name)
            ->where("title LIKE '%$search_what%'");
        return $data->query()->fetchAll();
    }

}

