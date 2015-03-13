<?php

class Application_Form_Worktime extends Zend_Form
{
 public function __construct($options = null)
    {
        parent::__construct($options);
        $this->setName('worktime');
		$id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
       
		$establishments = new Application_Model_DbTable_Establishments();
		$establishments_list = $establishments->getListEstablishments();
        $establishment_id = new Zend_Form_Element_Select('establishment');
        $establishment_id->setLabel('Establishment')
			->setMultiOptions($establishments_list)
            ->setRequired(true)
            ->addValidator('NotEmpty');
		
		$opening = new Zend_Form_Element_Select('opening');
        $opening->setLabel('Opening')
			->setMultiOptions(array(''=>'','6:00'=>'6:00', '7:00'=>'7:00', '8:00'=>'8:00', '9:00'=>'9:00', '10:00'=>'10:00', '11:00'=>'11:00', '12:00'=>'12:00', '24h'=>'24h'))
            ->setRequired(true)
            ->addValidator('NotEmpty');
			
		$break_from = new Zend_Form_Element_Select('break_from');
        $break_from->setLabel('Break from')
			->setMultiOptions(array(''=>'', '11:00'=>'11:00', '12:00'=>'12:00', '13:00'=>'13:00', '14:00'=>'14:00', '15:00'=>'15:00', '16:00'=>'16:00'));
           
		$break_to = new Zend_Form_Element_Select('break_to');
        $break_to->setLabel('Break to')
			->setMultiOptions(array(''=>'', '12:00'=>'12:00', '13:00'=>'13:00', '14:00'=>'14:00', '15:00'=>'15:00', '16:00'=>'16:00', '17:00'=>'17:00'));
           
		$closing = new Zend_Form_Element_Select('closing');
        $closing->setLabel('Closing')
			->setMultiOptions(array(''=>'', '18:00'=>'18:00', '19:00'=>'19:00', '20:00'=>'20:00', '21:00'=>'21:00', '22:00'=>'22:00', '23:00'=>'23:00', '00:00'=>'00:00', '01:00'=>'01:00', '02:00'=>'02:00', '03:00'=>'03:00', '04:00'=>'04:00', '05:00'=>'05:00' ));
           
		$weekend = new Zend_Form_Element_Select('weekend');
        $weekend->setLabel('Weekend')
			->setMultiOptions(array(''=>'', 'Sunday'=>'Sunday', 'Saturday'=>'Saturday', 'Friday'=>'Friday', 'Saturday-Sunday'=>'Saturday-Sunday', 'Sunday-Monday'=>'Sunday-Monday'));
          

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        $this->addElements(array($id, $establishment_id, $opening, $break_from, $break_to, $closing, $weekend, $submit));
    }

}

