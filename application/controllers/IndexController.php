<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $role = Zend_Registry::get('role');
        if ($role == 'admin'){
            $layout = Zend_Layout::getMvcInstance();
            $layout->setLayout('admin');
        }else{
            $layout = Zend_Layout::getMvcInstance();
            $layout->setLayout('layout');
        }
    }

    public function indexAction()
    {
        // action body
    }
}





