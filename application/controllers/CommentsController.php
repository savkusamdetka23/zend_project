<?php

class CommentsController extends Zend_Controller_Action
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

    function indexAction()
    {
        $this->view->title = "Comments";
        $this->view->headTitle($this->view->title);
        $comments = new Application_Model_DbTable_Comments();
        $this->view->comments = $comments->getCommentsList();
   }
    function addAction()
    {
        $this->view->title = "Add new Comment";
        $this->view->headTitle($this->view->title);
        $form = new Application_Form_Comments();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $username = $form->getValue('username');
                $comment = $form->getValue('comment');
                $comments = new Application_Model_DbTable_Comments();
                $comments->addComments($username, $comment);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

}

