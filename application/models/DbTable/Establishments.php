<?php
class Application_Model_DbTable_Establishments extends Zend_Db_Table_Abstract
{
    protected $_name = 'establishments';
	//	protected $_primary = 'addresses';
	//protected $_dependentTables = array('Application_Model_DbTable_Addresses');

	
	
	public function getEstablishment($id)
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
	/*public function getAddress()
    {
		$address = new Application_Model_DbTable_Addresses();
	$row->findDependentRow($address, 'id');
	return $row;
/*	$select = $this->establishments->getAdapter()->select()->from($this)->join('addresses', 'address.id=establishments.address_id')->where('address_id'=>'id'));

		$resultSet = $this->addresses->fetchAll($select);

		return $resultSet;

	*/	
		/*$addresses = new Application_Model_DbTable_Addresses();
		$addresses_id = $addresses->getAddresses($id);
		
		$select = $this->_db->select()
						->from($this->_name,
                array('key' => 'id', 'value' => 'street'));
        $result = $this->getAdapter()->fetchAll($select);
        return $result;
       /* $select =  $this->getAdapter()->select()->from($this)->join('street', 'establishments.address_id = addresses.id')->where('street = ?',$street);
		return $this->fetchAll($select);
	}*/
    public function getListEstablshments(){
    /*	$select = $this->getAdapter()->select()->from(array('establishments', 'establishments.id', 'establishments.address_id'))->join(array('addresses', 'addresses.id=establishments.address_id')->where('street');
    
    	return $this->getAdapter()->fetchAll($select);*/
		/*$select =  $this->getAdapter()->select()->from($this)->join('addresses', 'addresses.id = establishments.address_id')->where('street = ?',$street);
		return $this->fetchAll($select);
	*/	
    }
	
    public function getEstablishmentsList()
    {
		/*$results = $this->fetchAll($select);
		$item['address_id'] = $addresses[0]['id'];
//put other item's data here in item
		$addresses = array();
		$i = 0;
		foreach($results as $addresses){
		$establishments[$i]['address_id'] = $addresses['id']
  //put other image's data here in $images[$i]
		$i++;
		}
		$item['establishments'] = $establishments;
		*/
		

        $select = $this->getAdapter()->select()
		->from(array('est' => 'establishments'), 
				array('id', 
					  'title',
					  'address_id',
					  'gps',
					  'telephone',
					  'description'));
					foreach($resultSet as $item){
	$select = $this->getAdapter()->select()->joinLeft('addresses', 'addresses.id = establishments.address_id')->where('addresses.id = ?', $address_id);
					}
    			
    	return $this->getAdapter()->fetchAll($select);
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
