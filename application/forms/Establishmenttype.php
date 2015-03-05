<?php

class Application_Form_Establishmenttype extends Zend_Form
{

     public function __construct($options = null)
    {
        parent::__construct($options);
        $this->setName('establishmenttype');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $type = new Zend_Form_Element_Text('type');
        $type->setLabel('Type')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');
       
        $establishment = new Zend_Form_Element_Text('establishment');
        $establishment->setLabel('Establishment')
            ->setRequired(true)
            ->addValidator('NotEmpty');
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        $this->addElements(array($id, $type, $establishment, $submit));
    }


}

