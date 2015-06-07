<?php

class Application_Form_Comments extends Zend_Form
{

      public function __construct($options = null)
    {
        parent::__construct($options);
        $this->setName('comment');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
       
	    $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Name')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');
       
        $comment = new Zend_Form_Element_Text('comment');
        $comment->setLabel('Comments')
            ->setRequired(true)
            ->addValidator('NotEmpty');

        // Add a captcha
        $this->addElement('captcha', 'captcha', array(
            'label'      => 'Введите 5 цифр, которвые вы видите снизу:',
            'required'   => true,
            'captcha'    => array(
                'captcha' => 'Figlet',
                'wordLen' => 5,
                'timeout' => 300
            )
        ));
        
		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        $this->addElements(array($id, $username, $comment, $submit));
    }


}

