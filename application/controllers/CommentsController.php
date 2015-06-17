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
            $this->view->comments = $comments->getListComments();
        }

    function addAction()
    {
        $this->view->title = "Add new Comment";
        $this->view->headTitle($this->view->title);
        $form = new Application_Form_Comments();
        $form->submit->setLabel('Leave your comment');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $username = $form->getValue('username');
                $comment = $form->getValue('comment');
                $date= $form->getValue('date');
                $comments = new Application_Model_DbTable_Comments();
                $comments->addComments($username, $comment, $date);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function deleteAction()
    {
        $this->view->title = "Delete comment";
        $this->view->headTitle($this->view->title);
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $comments = new Application_Model_DbTable_Comments();
                $comments->deleteComment($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $comments = new Application_Model_DbTable_Comments();
            $this->view->comments = $comments->getCommentToDel($id);
        }
    }

}

