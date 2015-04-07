<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('layout');

        /*  $role = Zend_Registry::get('role');
         if ($role = 'admin'){
             $layout = Zend_Layout::getMvcInstance();
             $layout->setLayout('admin');
         }
         */
         //Initialize action controller here
    }

    public function indexAction()
    {
        // action body
    }




}





