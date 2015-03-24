<?php
class EstablishmentsController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('admin');
    }
    public function indexAction()
    {

		$establishments = new Application_Model_DbTable_Establishments();
		$establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;


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
                $build = $form->getValue('build');
                $address_id = $form->getValue('address_id');
                $gps = $form->getValue('gps');
                $telephone = $form->getValue('telephone');
                $description = $form->getValue('description');
                $establishmenttype_id= $form->getValue('establishmenttype_id');
                $establishments = new Application_Model_DbTable_Establishments();
                $establishments->addEstablishments($title, $build, $address_id, $gps, $telephone, $description, $establishmenttype_id);



                $query = $establishments->getAdapter()->select()
                    ->from('establishments')->where('establishments.telephone = ?', $telephone);
                $establishment_id = $establishments->getAdapter()->fetchAll($query);
                //die($establishment_id[0]['telephone']);
                //die(print_r($establishment_id));

                //   $establishment_id = $form->getValue('id');
                $opening = $form->getValue('opening');
                $break_from = $form->getValue('break_from');
                $break_to = $form->getValue('break_to');
                $closing = $form->getValue('closing');
                $weekend = $form->getValue('weekend');
                $worktime= new Application_Model_DbTable_Worktime();
                $worktime->addWorktime($establishment_id[0]['id'], $opening, $break_from, $break_to, $closing, $weekend);


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
                $build = $form->getValue('build');
                $address_id = $form->getValue('address_id');
				$gps = $form->getValue('gps');
				$telephone = $form->getValue('telephone');
               $description = $form->getValue('description');
                $establishmenttype_id= $form->getValue('establishmenttype_id');
                $establishments = new Application_Model_DbTable_Establishments();
                $establishments->updateEstablishments($id, $title, $build, $address_id, $gps, $telephone, $description, $establishmenttype_id);


               // $establishment_id = $establishments->getAdapter()->fetchAll($establishment_id);
                //die($establishment_id[0]['telephone']);


                // $id = $form->getValue('id');
               $establishment_id = $form->getValue('establishment_id');
                $opening = $form->getValue('opening');
                $break_from = $form->getValue('break_from');
                $break_to = $form->getValue('break_to');
                $closing = $form->getValue('closing');
                $weekend = $form->getValue('weekend');
               $worktime= new Application_Model_DbTable_Worktime();
                $worktime->updateWorktime($id, $establishment_id, $opening, $break_from, $break_to, $closing, $weekend);


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
            $form->populate($establishments->getEstablishment($id));

        }
            $establishment_id = $this->_getParam('id', 0);
            if ($establishment_id > 0) {
                // Создаём объект модели
                $worktime = new Application_Model_DbTable_Worktime();
		          // Заполняем форму информацией при помощи метода populate
                $form->populate($worktime->getWorktime($establishment_id));

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

    public function establishmentaAction()
    {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('layout');

        $establishments = new Application_Model_DbTable_Establishments();
        $listEstablishments = $establishments->getListEstablishments();
        $this->view->establishments = $listEstablishments;

    }

    public function establishmentcAction()
    {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('layout');
        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    }
    public function establishmentfAction()
    {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('layout');
        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    }
    public function establishmentnAction()
    {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('layout');
        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    }
    public function establishmenttAction()
    {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('layout');
        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    }
}