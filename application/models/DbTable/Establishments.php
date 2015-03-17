<?php
class Application_Model_DbTable_Establishments extends Zend_Db_Table_Abstract
{
    protected $_name = 'establishments';



	public function getEstablishment($id)
    {
        $id = (int)$id;
		$row = $this->fetchRow('id = ' . $id);
        if(!$row) {
            throw new Exception("There is no record with id - $id");
        }
        return $row->toArray();
    }


    public function getListEstablishments(){

        $select = $this->_db->select()
            ->from($this->_name,
                array('key' => 'id', 'value' => 'title'));
        $result = $this->getAdapter()->fetchAll($select);
        return $result;
    }



    public function getEstablishmentsList()
    {
        $select = $this->getAdapter()->select()
            ->from('establishments',
                array(
                    'establishments.id',
                    'establishments.title',
                    'establishments.build',
                    'establishments.address_id',
                    'establishments.gps',
                    'establishments.telephone',
                    'establishments.description',
                    'establishments.establishmenttype_id'
                ))
            ->joinLeft(array('addresses'), 'addresses.id=establishments.address_id', array('address' => 'street'))
            ->joinLeft(array('worktime'), 'worktime.establishment_id=establishments.id', array('open' =>'opening', 'break_f' =>'break_from', 'break_t' =>'break_to', 'close' =>'closing', 'weekends' =>'weekend'))
            ->joinLeft(array('establishmenttype'), 'establishmenttype.id=establishments.establishmenttype_id', array('type' => 'establishment'));
//print($select);

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
    public function addEstablishments($title, $build, $address_id, $gps, $telephone, $description, $establishmenttype_id)
    {
        $data = array(
            'title' => $title,
            'build' => $build,
            'address_id' => $address_id,
            'gps' => $gps,
            'telephone' => $telephone,
            'description' => $description,
			'establishmenttype_id' => $establishmenttype_id

        );
        $this->insert($data);
    }
	 public function updateEstablishments($id, $title, $build, $address_id, $gps, $telephone,  $description, $establishmenttype_id)
    {
        $data = array(
			'id' => $id,
            'title' => $title,
            'build' => $build,
            'address_id' => $address_id,
            'gps' => $gps,
            'telephone' => $telephone,
            'description' => $description,
            'establishmenttype_id' => $establishmenttype_id
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
