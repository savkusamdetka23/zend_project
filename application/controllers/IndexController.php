<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('layout');
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }




}





