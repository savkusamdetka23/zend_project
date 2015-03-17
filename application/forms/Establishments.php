<?php

class Application_Form_Establishments extends Zend_Form
{

   public function __construct($options = null)
    {
        parent::__construct($options);
        $this->setName('establishments');
      //  $this->setName('worktime');
	/*	$this->setMethod('post');
		$this->setAction('user/process');*/
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');


        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $build = new Zend_Form_Element_Text('build');
        $build->setLabel('Building №')
            ->setRequired(true)
            ->addValidator('NotEmpty');


		$addresses = new Application_Model_DbTable_Addresses();
		$addresses_list = $addresses->getListAddresses();
		$address_id = new Zend_Form_Element_Select('address_id');
        $address_id->setLabel('Street')
			->setMultiOptions($addresses_list)
            ->setRequired(true)
            ->addValidator('NotEmpty');


			$gps = new Zend_Form_Element_Text('gps');
			$gps->setLabel('GPS')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

				$telephone = new Zend_Form_Element_Text('telephone');
			$telephone->setLabel('Telephone')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');


			$description = new Zend_Form_Element_Textarea('description');
			$description->setLabel('Description')
            ->setRequired(true)
			->setAttrib('cols', 50)
            ->setAttrib('rows', 4)
            ->addFilter('StripTags')
            ->addValidator('StringLength', false, array(2, 250))
			 ->setErrorMessages(array('Text must be between 2 and 250 characters'));

        $establishmenttype = new Application_Model_DbTable_Establishmenttype();
        $establishmenttype_list = $establishmenttype->getListEstablishmenttype();
        $establishmenttype_id = new Zend_Form_Element_Select('establishmenttype_id');
        $establishmenttype_id->setLabel('Establishment type')
            ->setMultiOptions($establishmenttype_list)
            ->setRequired(true)
            ->addValidator('NotEmpty');



        $establishment_id = new Zend_Form_Element_Hidden('establishment_id');
        $establishment_id ->addFilter('Int');


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
        $this->addElements(array($id, $title, $build, $address_id, $gps, $telephone, $description, $establishmenttype_id, $establishment_id, $opening, $break_from, $break_to, $closing, $weekend, $submit));
    }

}

