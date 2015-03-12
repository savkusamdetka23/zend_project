<?php

class Application_Model_DbTable_Addresses extends Zend_Db_Table_Abstract
{

    protected $_name = 'addresses';
	public function getAddresses($id)
    {
        $id = (int)$id;


        $row = $this->fetchRow('id = ' . $id);
       
          return $row->toArray();
    }
    public function getAddressesList()
    {
        $select = $this->getAdapter()->select()
            ->from('addresses',
                array(
                    'addresses.city',
                    'addresses.street'
                ));

        return $this->getAdapter()->fetchAll($select);
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
    public function addAddresses($city, $street)
    {
        $data = array(
            'city' => $city,
            'street' => $street,
        );
        $this->insert($data);
    }
	 public function updateAddresses($id, $city, $street)
    {
        $data = array(
			'city' => $city,
            'street' => $street,
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

