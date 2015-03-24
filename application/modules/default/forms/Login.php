<?php

class Application_Form_Login extends Zend_Form
{
    public function __construct($options = null)
    {
		parent ::__construct($options);
        // указываем имя формы
        $this->setName('login');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'must not be empty';

        // создаём текстовый элемент
        $username = new Zend_Form_Element_Text('username');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $username->setLabel('User name:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        // создаём элемент формы для пароля
        $password = new Zend_Form_Element_Password('password');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $password->setLabel('Password:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        // создаём кнопку submit
        $login = new Zend_Form_Element_Submit('login');
        $login->setLabel('Login');

        // добавляем элементы в форму
        $this->addElements(array($username, $password, $submit));

        // указываем метод передачи данных
        $this->setMethod('post');
        $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl());
		
    }
}
