<?php

class AddressesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    function indexAction()
    {
        $this->view->title = "Addresses";
        $this->view->headTitle($this->view->title);
        $addresses = new Application_Model_DbTable_Addresses();
        $this->view->addresses = $addresses->fetchAll();
    }
    function addAction()
    {
        $this->view->title = "Add new address";
        $this->view->headTitle($this->view->title);
        $form = new Application_Form_Addresses();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $city = $form->getValue('city');
                $street = $form->getValue('street');
                $addresses = new Application_Model_DbTable_Addresses();
                $addresses->addAddresses($city, $street);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }
	public function editAction()
	{
		$form = new Application_Form_Addresses();
		$form->submit->setLabel('Edit');
		$this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
				$id = $form->getValue('id');
				$city = $form->getValue('city');
                $street = $form->getValue('street');
                $addresses = new Application_Model_DbTable_Addresses();
                $addresses->updateAddresses($id, $city, $street);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }else {
        // Если мы выводим форму, то получаем id фильма, который хотим обновить
        $id = $this->_getParam('id', 0);
        if ($id > 0) {
            // Создаём объект модели
            $addresses = new Application_Model_DbTable_Addresses();
            
            // Заполняем форму информацией при помощи метода populate
            $form->populate($addresses->getAddresses($id));
        }
    }
	}
    public function deleteAction()
    {
        $this->view->title = "Delete address";
        $this->view->headTitle($this->view->title);
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $addresses = new Application_Model_DbTable_Addresses();
                $addresses->deleteAddresses($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $addresses = new Application_Model_DbTable_Addresses();
            $this->view->addresses = $addresses->getAddressesToDel($id);
        }
    }


}

