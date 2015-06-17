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


    public function getEstablishmentRow($id){

        $select = $this->_db->select()
            ->from('establishments',
                array(
                    'establishments.id',
                    'establishments.title',
                    'establishments.image',
                    'establishments.build',
                    'establishments.address_id',
                    'establishments.gps',
                    'establishments.telephone',
                    'establishments.description',
                    'establishments.establishmenttype_id'
                ))->where('establishments.id = ?', $id)
            ->joinLeft(array('addresses'), 'addresses.id=establishments.address_id', array('address' => 'street', 'town' => 'city'))
            ->joinLeft(array('worktime'), 'worktime.establishment_id=establishments.id', array('opening' =>'opening', 'break_from' =>'break_from', 'break_to' =>'break_to', 'closing' =>'closing', 'weekend' =>'weekend'))
            ->joinLeft(array('establishmenttype'), 'establishmenttype.id=establishments.establishmenttype_id', array('establishment' => 'establishment'));
          $result = $this->getAdapter()->fetchRow($select);
        return $result;
   }



    public function getEstablishmentsList($type = '*', $offset = 0)
    {
        $select = $this->getAdapter()->select()
            ->from('establishments',
                array(
                    'establishments.id',
                    'establishments.title',
                    'establishments.image',
                    'establishments.build',
                    'establishments.address_id',
                    'establishments.gps',
                    'establishments.telephone',
                    'establishments.description',
                    'establishments.establishmenttype_id'
                ));
        ($type != '*') ? $select->where('establishments.establishmenttype_id = ?', $type)->limit(5, $offset) : '';
            $select->joinLeft(array('addresses'), 'addresses.id=establishments.address_id', array('address' => 'street', 'town' => 'city'))
            ->joinLeft(array('worktime'), 'worktime.establishment_id=establishments.id', array('opening' =>'opening', 'break_from' =>'break_from', 'break_to' =>'break_to', 'closing' =>'closing', 'weekend' =>'weekend'))
            ->joinLeft(array('establishmenttype'), 'establishmenttype.id=establishments.establishmenttype_id', array('establishment' => 'establishment', 'type' => 'type'));

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
    public function addEstablishments($title, $image, $build, $address_id, $gps, $telephone, $description, $establishmenttype_id)
    {
        $data = array(
            'title' => $title,
            'image' => $image,
            'build' => $build,
            'address_id' => $address_id,
            'gps' => $gps,
            'telephone' => $telephone,
            'description' => $description,
			'establishmenttype_id' => $establishmenttype_id

        );
        $this->insert($data);
    }
	 public function updateEstablishments($id, $title, $image, $build, $address_id, $gps, $telephone,  $description, $establishmenttype_id)
    {
        $data = array(
			'id' => $id,
            'title' => $title,
            'image' => $image,
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

    public  function getrandomList()
    {

        $select = $this->getAdapter()->select()
            ->from('establishments',
                array(
                    'establishments.id',
                    'establishments.title',
                    'establishments.image',
                    'establishments.build',
                    'establishments.address_id',
                    'establishments.gps',
                    'establishments.telephone',
                    'establishments.description',
                    'establishments.establishmenttype_id'
                ))
            ->joinLeft(array('addresses'), 'addresses.id=establishments.address_id', array('address' => 'street', 'town' => 'city'))
            ->joinLeft(array('worktime'), 'worktime.establishment_id=establishments.id', array('opening' =>'opening', 'break_from' =>'break_from', 'break_to' =>'break_to', 'closing' =>'closing', 'weekend' =>'weekend'))
            ->joinLeft(array('establishmenttype'), 'establishmenttype.id=establishments.establishmenttype_id', array('establishment' => 'establishment')) ;



        return $this->getAdapter()->fetchAll($select
                ->order('RAND()')
                ->limit(5)

        );

}

    public  function getnewestList()
    {

        $select = $this->getAdapter()->select()
            ->from('establishments',
                array(
                    'establishments.id',
                    'establishments.title',
                    'establishments.image',
                    'establishments.build',
                    'establishments.address_id',
                    'establishments.gps',
                    'establishments.telephone',
                    'establishments.description',
                    'establishments.establishmenttype_id'
                ))
            ->joinLeft(array('addresses'), 'addresses.id=establishments.address_id', array('address' => 'street', 'town' => 'city'))
            ->joinLeft(array('worktime'), 'worktime.establishment_id=establishments.id', array('opening' =>'opening', 'break_from' =>'break_from', 'break_to' =>'break_to', 'closing' =>'closing', 'weekend' =>'weekend'))
            ->joinLeft(array('establishmenttype'), 'establishmenttype.id=establishments.establishmenttype_id', array('establishment' => 'establishment')) ;



        return $this->getAdapter()->fetchAll($select
                ->order('establishments.id DESC')
                ->limit(5)

        );
    }

  }
