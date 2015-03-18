<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }
    function _initViewRes() {
        $this->bootstrap('view');
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        return $view;
    }

}

