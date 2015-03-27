<?php

class EstablishmenttypeController extends Zend_Controller_Action
{

    public function init()
    {
         $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('admin');
    }

    function indexAction()
    {
        $this->view->title = "Establishment type";
        $this->view->headTitle($this->view->title);

        $establishmenttype = new Application_Model_DbTable_Establishmenttype();
        $this->view->establishmenttype = $establishmenttype->getEstablishmenttypeList();
    }
    function addAction()
    {
        $this->view->title = "Add new establishment type";
        $this->view->headTitle($this->view->title);

        $form = new Application_Form_Establishmenttype();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $type = $form->getValue('type');
                $establishment = $form->getValue('establishment');

                $establishmenttype = new Application_Model_DbTable_Establishmenttype();
                $establishmenttype->addEstablishmenttype($type, $establishment);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }
	public function editAction()
	{
		$form = new Application_Form_Establishmenttype();
		$form->submit->setLabel('Edit');

		$this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
				$id = $form->getValue('id');
				$type = $form->getValue('type');
                $establishment = $form->getValue('establishment');

                $establishmenttype = new Application_Model_DbTable_Establishmenttype();
                $establishmenttype->updateEstablishmenttype($id, $type, $establishment);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }else {
        // Отримання id потрібного елемента
        $id = $this->_getParam('id', 0);
        if ($id > 0) {
            // Створюємо об'єкт моделі
            $establishment = new Application_Model_DbTable_Establishmenttype();
            
            // ЗАповнюємо форму за допомогою метода populate
            $form->populate($establishment->getEstablishmenttype($id));
        }
    }
	}
	
    public function deleteAction()
    {
        $this->view->title = "Delete establishment type";
        $this->view->headTitle($this->view->title);
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $establishmenttype = new Application_Model_DbTable_Establishmenttype();
                $establishmenttype->deleteEstablishmenttype($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $establishmenttype = new Application_Model_DbTable_Establishmenttype();
            $this->view->establishmenttype = $establishmenttype->getEstablishmenttypeToDel($id);
        }
    }


}

