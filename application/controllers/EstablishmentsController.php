<?php

class EstablishmentsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->title = "Establishments";
        $this->view->headTitle($this->view->title);
        $establishments = new Application_Model_DbTable_Establishments();
        $this->view->establishments = $establishments->fetchAll();
		//$addresses_id = $this->_getParam('id', 0);
		//$addresses_id = new Application_Model_DbTable_Addresses();
	//	$this->view->addresses = $addresses->fetchAll();
		
	/*	$street_list = new Application_Model_DbTable_Incentive();
		$this->view->street_list = $street_list->getIncentivesList();*/
    }
 function addAction()
    {
        $this->view->title = "Add new establishment";
        $this->view->headTitle($this->view->title);
        $form = new Application_Form_Establishments();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
			
            if ($form->isValid($formData)) {
                $title = $form->getValue('title');
				$address_id = $form->getValue(address_id);
				$gps = $form->getValue('gps');
				$telephone = $form->getValue('telephone');
				$description = $form->getValue('description');
				$establishments = new Application_Model_DbTable_Establishments();
                $establishments->addEstablishments($title, $address_id, $gps, $telephone, $description);
				
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }
	public function editAction()
	{
		$form = new Application_Form_Establishments();
		$form->submit->setLabel('Edit');
		$this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
				$id = $form->getValue('id');
				$title = $form->getValue('title');
                $address_id = $form->getValue('address_id');
				$gps = $form->getValue('gps');
				$telephone = $form->getValue('telephone');
				$description = $form->getValue('description');
                $establishments = new Application_Model_DbTable_Establishments();
                $establishments->updateEstablishments($id, $title, $address_id, $gps, $telephone, $description);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }else {
        // Если мы выводим форму, то получаем id фильма, который хотим обновить
        $id = $this->_getParam('id', 0);
        if ($id > 0) {
            // Создаём объект модели
            $establishments = new Application_Model_DbTable_Establishments();
            
            // Заполняем форму информацией при помощи метода populate
            $form->populate($establishments->getEstablishments($id));
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
                $establishments = new Application_Model_DbTable_Establishments();
                $establishments->deleteEstablishments($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $establishments = new Application_Model_DbTable_Establishments();
            $this->view->establishments = $establishments->getEstablishmentsToDel($id);
        }
    }

}

