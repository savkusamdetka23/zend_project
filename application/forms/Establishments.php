<?php

class Application_Form_Establishments extends Zend_Form
{

   public function __construct($options = null)
    {
        parent::__construct($options);
        $this->setName('establishments');
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
			

		$addresses = new Application_Model_DbTable_Addresses();
		$addresses_list = $addresses->getAddressesList();
		$street_select = new Zend_Form_Element_Select('address_id');
        $street_select->setLabel('Street')
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

        $worktime= new Application_Model_DbTable_Worktime();
        $worktime_list = $worktime->getWorktimeList();
        $worktime_select = new Zend_Form_Element_Select('worktime_id');
        $worktime_select->setLabel('Work time')
            ->setMultiOptions($worktime_list)
            ->setRequired(true)
            ->addValidator('NotEmpty');
			
			$description = new Zend_Form_Element_Textarea('description');
			$description->setLabel('Description')
            ->setRequired(true)
			->setAttrib('cols', 50)
            ->setAttrib('rows', 4)
            ->addFilter('StripTags')
            ->addValidator('StringLength', false, array(40, 250))
			 ->setErrorMessages(array('Text must be between 40 and 250 characters'));

        $establishmenttype = new Application_Model_DbTable_Establishmenttype();
        $establishmenttype_list = $establishmenttype->getEstablishmenttypeList();
        $establishmenttype_select = new Zend_Form_Element_Select('establishmenttype_id');
        $establishmenttype_select->setLabel('Establishment type')
            ->setMultiOptions($establishmenttype_list)
            ->setRequired(true)
            ->addValidator('NotEmpty');


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        $this->addElements(array($id, $title, $street_select, $gps, $telephone, $worktime_select, $description, $establishmenttype_select, $submit));
    }

}

