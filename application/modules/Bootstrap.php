<?php


class Admin_Bootstrap extends Zend_Application_Module_Bootstrap {
 protected function _initAutoload()
{
    $moduleLoader = new Zend_Application_Module_Autoloader(
        array( 'namespace' => '',
            'basePath' => APPLICATION_PATH));
    return  $moduleLoader;
}

    protected function _initLayoutHelper()
{

    $this->bootstrap ( 'frontController' );
    $layout = Zend_Controller_Action_HelperBroker::addHelper(
        new Add_LayoutLoader());
}
    protected function _initAcl()
    {
        // Создаём объект Zend_Acl
    /*    $acl = new Zend_Acl();

        // Добавляем ресурсы нашего сайта,
        // другими словами указываем контроллеры и действия

        // указываем, что у нас есть ресурс index
        $acl->addResource('index');

    //    $acl->addResource('index', 'index');

        $acl->addResource('addresses');
 /*       $acl->addResource('add', 'addresses');
        $acl->addResource('edit', 'addresses');
        $acl->addResource('delete', 'addresses');*/
     //   $acl->addResource('index', 'addresses');

      //  $acl->addResource('establishmenttype');
    /*    $acl->addResource('add', 'establishmenttype');
        $acl->addResource('edit', 'establishmenttype');
        $acl->addResource('delete', 'establishmenttype');
        $acl->addResource('index', 'establishmenttype');
*/
    //    $acl->addResource('establishments');
  /*      $acl->addResource('add', 'establishments');
        $acl->addResource('edit', 'establishments');
        $acl->addResource('delete', 'establishments');
        $acl->addResource('index', 'establishments');
*/
    /*    $acl->addResource('worktime');
         /*      $acl->addResource('add', 'worktime');
        $acl->addResource('edit', 'worktime');
        $acl->addResource('delete', 'worktime');
        $acl->addResource('index', 'worktime');
       */
        // указываем, что у нас есть ресурс error
   /*     $acl->addResource('error');

        // указываем, что у нас есть ресурс auth
        $acl->addResource('auth');

        // ресурс login является потомком ресурса auth
        $acl->addResource('login', 'auth');

        // ресурс logout является потомком ресурса auth
        $acl->addResource('logout', 'auth');

        // далее переходим к созданию ролей, которых у нас 2:
        // гость (неавторизированный пользователь)
        $acl->addRole('guest');
*/
        // администратор, который наследует доступ от гостя
  /*     $acl->addRole('admin', 'guest');

        // разрешаем гостю просматривать ресурс index
        $acl->allow('guest', 'index', array('index'));
*/
        // разрешаем гостю просматривать ресурс auth и его подресурсы
   //     $acl->allow('guest', 'auth', array('index', 'login', 'logout'));
     //  $acl->allow('guest', 'addresses', array('index'));

        // даём администратору доступ к ресурсам 'add', 'edit' и 'delete'
       // $acl->allow('admin', 'addresses', array('index'));
   //        $acl->allow('admin', 'addresses', array('add', 'edit', 'delete'));
        /*    $acl->allow('admin', 'establishmenttype', array('add', 'edit', 'delete'));
            $acl->allow('admin', 'establishments', array('add', 'edit', 'delete'));
            $acl->allow('admin', 'worktime', array('add', 'edit', 'delete'));
*/
        // разрешаем администратору просматривать страницу ошибок
       /* $acl->allow('admin', 'error');

        // получаем экземпляр главного контроллера
        $fc = Zend_Controller_Front::getInstance();

        // регистрируем плагин с названием AccessCheck, в который передаём
        // на ACL и экземпляр Zend_Auth
        $fc->registerPlugin(new Application_Plugin_AccessCheck($acl, Zend_Auth::getInstance()));
        */
    }
}
?>