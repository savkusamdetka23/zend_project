<?php

class Application_Form_Addresses extends Zend_Form
{

    public function __construct($options = null)
    {
        parent::__construct($options);
        $this->setName('addresses');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $city = new Zend_Form_Element_Text('city');
        $city->setLabel('City')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');
       
        $street = new Zend_Form_Element_Text('street');
        $street->setLabel('Street')
            ->setRequired(true)
            ->addValidator('NotEmpty');
			
	
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        $this->addElements(array($id, $city, $street, $submit));
    }


}

