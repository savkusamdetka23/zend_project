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
        //    $this->add(new Zend_Acl_Resource('auth'), 'login');


            $this->addRole(new Zend_Acl_Role('guest'));
            $this->addRole(new Zend_Acl_Role('user'), 'guest');
            $this->addRole(new Zend_Acl_Role('admin'), 'user');


            $this->allow('guest', 'index');
            $this->allow('guest', 'auth');
           // $this->deny(null, 'auth', logout'');
            $this->allow('guest', 'establishments', 'establishmenta');
            $this->allow('guest', 'establishments', 'establishmentc');
            $this->allow('guest', 'establishments', 'establishmentf');
            $this->allow('guest', 'establishments', 'establishmentn');
            $this->allow('guest', 'establishments', 'establishmentt');

            $this->deny('user', 'auth', 'login');

            $this->allow('admin', 'addresses');

            $this->allow('admin', 'establishments');

            $this->allow('admin', 'establishmenttype');

            $this->allow('admin', 'worktime');

        }

}

