<?php
class Application_Plugin_AccessCheck extends Zend_Controller_Plugin_Abstract
{
    private $_acl = null;

    public function __construct(Zend_Acl $acl)
    {
        $this->_acl = $acl;
    }

    public  function  preDispatch(Zend_Controller_Request_Abstract $request){
        $resource = $request->getControllerName();
        $action = $request->getActionName();


     /*   if (!$this->_acl->isAllowed(Zend_Registry::get('role'), $resource, $action)) {
            $request->setControllerName('auth')
                    ->setActionName('login');
        }
*/

     /*  if ($this->_acl->isAllowed(Zend_Registry::get('role', 'admin'), $resource, $action)) {

            $layout = Zend_Layout::getMvcInstance();
            $layout->setLayout('admin');
        }

        $role = Zend_Registry::get('role');
        if($role = 'admin'){
            $layout = Zend_Layout::getMvcInstance();
            $layout->setLayout('admin');
        }
*/
    }




 /*   public function preDispatch(Zend_Controller_Request_Abstract $request) {
        // получаем имя текущего ресурса
        $resource = $request->getControllerName();

        // получаем имя action
        $action = $request->getActionName();

        // получаем доступ к хранилищу данных Zend,
        // и достаём роль пользователя
        $identity = $this->_auth->getStorage()->read();

        // если в хранилище ничего нет, то значит мы имеем дело с гостем
        $role = !empty($identity->role) ? $identity->role : 'guest';

        // если пользователь не допущен до данного ресурса,
        // то отсылаем его на страницу авторизации
        if (!$this->_acl->isAllowed($role, $resource, $action)) {
            $request->setControllerName('auth')->setActionName('index');
        }
    }*/
}
