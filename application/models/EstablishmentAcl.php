<?php

class Application_Model_EstablishmentAcl extends Zend_Acl
{
        public function __construct(){



            $this->add(new Zend_Acl_Resource('index'));



            $this->add(new Zend_Acl_Resource('addresses'));

            $this->add(new Zend_Acl_Resource('establishmenttype'));
            $this->add(new Zend_Acl_Resource('establishments'));
          //  $this->add(new Zend_Acl_Resource('establishment'));
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


            $this->allow(null, 'index');
          //  $this->allow(null, 'establishment');
           // $this->allow('user', 'index');
            $this->allow(null, 'auth');
            $this->allow(null, 'establishments', 'establishmenta');
            $this->allow(null, 'establishments', 'establishmentc');
            $this->allow(null, 'establishments', 'establishmentf');
            $this->allow(null, 'establishments', 'establishmentn');
            $this->allow(null, 'establishments', 'establishmentt');

            $this->allow('admin', 'addresses');

            $this->allow('admin', 'establishments');

            $this->allow('admin', 'establishmenttype');

            $this->allow('admin', 'worktime');

        }

}

