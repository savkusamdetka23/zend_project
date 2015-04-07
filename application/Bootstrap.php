<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    private $_acl = null;


    protected function _initAutoload(){
        $modelLoader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath' => 'APPLICATION_PATH'));

        if(Zend_Auth::getInstance()->hasIdentity()){
         Zend_Registry::set('role', Zend_Auth::getInstance()->getStorage()->read()->role);
        }else{
            Zend_Registry::set('role', 'guest');
        }

        $this->_acl = new Application_Model_EstablishmentAcl();
        $this->_auth = Zend_Auth::getInstance();



        $fc = Zend_Controller_Front::getInstance();
        $fc->registerPlugin(new Application_Plugin_AccessCheck($this->_acl));

        return $modelLoader;




    }




}
