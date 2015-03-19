<?php
class Application_Model_DbTable_Worktime extends Zend_Db_Table_Abstract
{

    protected $_name = 'worktime';
	
	public function getWorktime($establishment_id)
    {
       $select = $this->getAdapter()->select()
            ->from('worktime')->where('worktime.establishment_id = ?', $establishment_id);
        $result = $this->getAdapter()->fetchAll($select);
        return $result;
		
		
		
    }
    public function getWorktimeList()
    {
        $select = $this->getAdapter()->select()
            ->from('worktime',
                array(
                    'worktime.id',
                    'worktime.establishment_id',
                    'worktime.opening',
                    'worktime.break_from',
                    'worktime.break_to',
                    'worktime.closing',
                    'worktime.weekend'
                ))
            ->joinLeft(array('establishments'), 'establishments.id = worktime.establishment_id', array('establishment' => 'title'));


        return $this->getAdapter()->fetchAll($select);
    }
    public function getListWorktime(){
        /*	$select = $this->getAdapter()->select()->from(array('establishments', 'establishments.id', 'establishments.address_id'))->join(array('addresses', 'addresses.id=establishments.address_id')->where('street');

            return $this->getAdapter()->fetchAll($select);*/
        /*$select =  $this->getAdapter()->select()->from($this)->join('addresses', 'addresses.id = establishments.address_id')->where('street = ?',$street);
        return $this->fetchAll($select);
    */
        $select = $this->_db->select()
            ->from($this->_name,
                array('key' => 'id', 'value' => 'establishment_id'));
        $result = $this->getAdapter()->fetchAll($select);
        return $result;
    }

    public function getWorktimeToDel($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Cannot find row id");
        }
        return $row->toArray();
    }
    public function addWorktime( $establishment_id, $opening, $break_from, $break_to, $closing, $weekend)
    {
        $data = array(
            'establishment_id' => $establishment_id,
            'opening' => $opening,
			'break_from' => $break_from,
			'break_to' => $break_to,
			'closing' => $closing,
			'weekend' => $weekend
        );
        $this->insert($data);
    }
	 public function updateWorktime($id, $establishment_id, $opening, $break_from, $break_to, $closing, $weekend)
    {
        $data = array(
			'id' => $id,
			'establishment_id' => $establishment_id,
            'opening' => $opening,
			'break_from' => $break_from,
			'break_to' => $break_to,
			'closing' => $closing,
			'weekend' => $weekend
        );
       	$this->update($data, 'id = '.(int)$id);
    }
    public function deleteWorktime($id)
    {
        $this->delete('id = ' . (int)$id);
    }
    public function searchInTable($search_what)
    {
        $data = $this->select()
            ->from($this->_name)
            ->where("worktime LIKE '%$search_what%'");
        return $data->query()->fetchAll();
    }

}

