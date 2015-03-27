<?php

class Application_Form_Login extends Zend_Form
{
    public function __construct($option = null)
    {

        parent::__construct($option);
        // Вказуємо ім'я форми
        $this->setName('login');

        // Повідомлення про незаповнену форму
        $isEmptyMessage = 'must not be empty';

        // Створюємо текстовий елемент
        $username = new Zend_Form_Element_Text('username');

        // Призначаємо йому label і відмічаємо як обов'язкове поле
        // також додаємо фільри та валідатор
        $username->setLabel('Name:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        // Створюємо елемент форми для пароля
        $password = new Zend_Form_Element_Password('password');

        // Призначаємо йому label і відмічаємо як обов'язкове поле
        // також додаємо фільри та валідатор
        $password->setLabel('Password:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        // Створюємо кнопку submit
        $login = new Zend_Form_Element_Submit('login');
        $login->setLabel('Login');

        // Додаємо елементи у форму
        $this->addElements(array($username, $password, $login));

        // Вказуємо метод передачі даних
        $this->setMethod('post');
       $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/auth/login');
    }
}
