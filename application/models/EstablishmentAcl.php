<?php

class Application_Model_EstablishmentAcl extends Zend_Acl
{
        public function __construct(){



            $this->add(new Zend_Acl_Resource('index'));



            $this->add(new Zend_Acl_Resource('addresses'));

            $this->add(new Zend_Acl_Resource('establishmenttype'));
            $this->add(new Zend_Acl_Resource('establishments'));
            $this->add(new Zend_Acl_Resource('worktime'));
            $this->add(new Zend_Acl_Resource('auth'));


            //$this->add(new Zend_Acl_Resource('index'), 'establishments');
  /*          $this->add(new Zend_Acl_Resource('edit'), 'establishments');
            $this->add(new Zend_Acl_Resource('add'), 'establishments');
            $this->add(new Zend_Acl_Resource('delete'), 'establishments');
            $this->add(new Zend_Acl_Resource('establishmenta'), 'establishments');
            $this->add(new Zend_Acl_Resource('establishmentc'), 'establishments');
            $this->add(new Zend_Acl_Resource('establishmentf'), 'establishments');
            $this->add(new Zend_Acl_Resource('establishmentn'), 'establishments');
            $this->add(new Zend_Acl_Resource('establishmentt'), 'establishments');
*/



            $this->addRole(new Zend_Acl_Role('user'));
            $this->addRole(new Zend_Acl_Role('admin'), 'user');

          //  $this->allow('user', 'establishments', 'index');
           // $this->allow('user', 'index', 'index');
            $this->allow('user', 'index');
            $this->allow('user', 'auth');
            $this->allow('user', 'establishments', 'establishmenta');
            $this->allow('user', 'establishments', 'establishmentc');
            $this->allow('user', 'establishments', 'establishmentf');
            $this->allow('user', 'establishments', 'establishmentn');
            $this->allow('user', 'establishments', 'establishmentt');

            $this->allow('admin', 'addresses');

            $this->allow('admin', 'establishments');

            $this->allow('admin', 'establishmenttype');

            $this->allow('admin', 'worktime');

        }

}

