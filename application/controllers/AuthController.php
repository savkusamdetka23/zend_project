<?php

class AuthController extends Zend_Controller_Action
{
    public function init()
    {
        $role = Zend_Registry::get('role');
        if ($role == 'admin'){
            $layout = Zend_Layout::getMvcInstance();
            $layout->setLayout('admin');
        }else{
            $layout = Zend_Layout::getMvcInstance();
            $layout->setLayout('layout');
        }
    }
    public function indexAction()
    {
        $this->_helper->redirector('login');
   }
    public function loginAction()
    {
        $this->view->title = 'Login';

        if (Zend_Auth::getInstance()->hasIdentity()) {
            // якщо так, то робимо редирект, щоб уникнути багаторазової авторизації
            $this->_helper->redirector('index', 'index');
        }
        $request = $this->getRequest();
        $form = new Application_Form_Login();
        if($request->isPost()){
                if($form->isValid($this->_request->getPost())){
                    $authAdapter = $this->getAuthAdapter();
                    $username = $form->getValue('username');
                    $password = $form->getValue('password');
                    $authAdapter ->setIdentity($username)
                        ->setCredential($password);

                    $auth = Zend_Auth::getInstance();
                    $result = $auth->authenticate($authAdapter);

                    if($result->isValid()){
                        $identity = $authAdapter->getResultRowObject();

                        $authStorage = $auth->getStorage();
                        $authStorage->write($identity);
                        $this->_helper->redirector('index');
                    }else{
                        $this->view->errMessage = 'Sorry, You have entered wrong name or password';
                    }
                }
        }
        $this->view->form = $form;
    }
    public function logoutAction()
    {
        // знищуємо інформацію про авторизацію користувача
        Zend_Auth::getInstance()->clearIdentity();
        // направляємо його на головну
        $this->_helper->redirector('index', 'index');
    }
    private function getAuthAdapter(){

        $authApadter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $authApadter ->setTableName('users')
                     ->setIdentityColumn('username')
                      ->setCredentialColumn('password');
        return $authApadter;
    }
}

