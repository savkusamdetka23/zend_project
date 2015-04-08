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
            ->joinLeft(array('addresses'), 'addresses.id=establishments.address_id', array('address' => 'street', 'town' => 'city'))
            ->joinLeft(array('worktime'), 'worktime.establishment_id=establishments.id', array('opening' =>'opening', 'break_from' =>'break_from', 'break_to' =>'break_to', 'closing' =>'closing', 'weekend' =>'weekend'))
            ->joinLeft(array('establishmenttype'), 'establishmenttype.id=establishments.establishmenttype_id', array('establishment' => 'establishment'));
        //      ->joinInner(array('establishmenttype'), 'establishmenttype.type[accomodation]=establishmenttype.type[accomodation]s', array('types' => 'type'));
        $result = $this->getAdapter()->fetchAll($select);
        return $result;

        /*   $select = $this->getAdapter()->select()
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
              ->joinLeft(array('addresses'), 'addresses.id=establishments.address_id', array('address' => 'street', 'town' => 'city'))
              ->joinLeft(array('worktime'), 'worktime.establishment_id=establishments.id', array('opening' =>'opening', 'break_from' =>'break_from', 'break_to' =>'break_to', 'closing' =>'closing', 'weekend' =>'weekend'))
              ->joinLeft(array('establishmenttype'), 'establishmenttype.id=establishments.establishmenttype_id', array('establishment' => 'establishment'));
           //      ->joinInner(array('establishmenttype'), 'establishmenttype.type[accomodation]=establishmenttype.type[accomodation]s', array('types' => 'type'));
  //print($select);

          return $this->getAdapter()->fetchAll($select);*/
    }



    public function getEstablishmentsList()
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
            ->joinLeft(array('establishmenttype'), 'establishmenttype.id=establishments.establishmenttype_id', array('establishment' => 'establishment', 'type' => 'type'));
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

 /*   public function populate($data)
    {
        foreach($data as $field => $value)
        {

            $formData = $this->getRequest()->getPost();

            if ($data->isValid($formData)) {

                $this->$id->setValue('id');
                $this->$title->setValue('title');
                $this->$build->setValue('build');
                $this->$address_id->setValue('address_id');
                $this->$gps->setValue('gps');
                $this->$telephone->setValue('telephone');


                $this->$establishment_id->setValue('establishment_id');
                $this->$opening->setValue('opening');
                $this->$break_from->setValue('break_from');
                $this->$break_to->setValue('break_to');
                $this->$closing->setValue('closing');
                $this->$weekend->setValue('weekend');


            }
        return $this;
    }


}*/
}
