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
            ->addValidator('NotEmpty')
            ->setErrorMessages(array('Please, enter your name'));
       
        $comment = new Zend_Form_Element_Textarea('comment');
        $comment->setLabel('Comment')
            ->setRequired(true)
            ->setAttrib('cols', 50)
            ->setAttrib('rows', 4)
            ->addFilter('StripTags')
            ->addValidator('StringLength', false, array(2, 999))
            ->setErrorMessages(array('Text must be between 2 and 250 characters'));

        // Add a captcha
        $this->addElement('captcha', 'captcha', array(
            'label'      => 'To post a comment, enter 5 characters, that you see below:',
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

