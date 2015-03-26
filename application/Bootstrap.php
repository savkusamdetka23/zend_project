<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAutoload(){
        $modelLoader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath' => 'APPLICATION_PATH'));

        $acl = new Application_Model_EstablishmentAcl();
        $auth = Zend_Auth::getInstance();

        $fc = Zend_Controller_Front::getInstance();
        $fc->registerPlugin(new Application_Plugin_AccessCheck($acl, $auth));

        return $modelLoader;

    }

    function _initViewHelpers(){
        $this->bootstrap('layout');
        $layout = $this->getResource(layout);
        $view = $layout->getView();

        $view->doctype('HTML4_STRICT');
        $view->headmeta()->appendHttpEquiv('Content-type','text/html;charset=utf-8')
                         ->appendName('description', 'Using view helpers in Zend_view');

    }


}
