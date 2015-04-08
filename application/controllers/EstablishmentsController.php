<?php
class EstablishmentsController extends Zend_Controller_Action
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
                $image = $form->getValue('image');
                $build = $form->getValue('build');
                $address_id = $form->getValue('address_id');
                $gps = $form->getValue('gps');
                $telephone = $form->getValue('telephone');
                $description = $form->getValue('description');
                $establishmenttype_id= $form->getValue('establishmenttype_id');

                $establishments = new Application_Model_DbTable_Establishments();
                $establishments->addEstablishments($title, $image, $build, $address_id, $gps, $telephone, $description, $establishmenttype_id);

                $query = $establishments->getAdapter()->select()
                                        ->from('establishments')->where('establishments.telephone = ?', $telephone);
                $establishment_id = $establishments->getAdapter()->fetchAll($query);

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
				$image = $form->getValue('image');

                // $form->image->receive();

            /*     $upload = new Zend_File_Transfer_Adapter_Http();
               $upload->setDestination('images/');
               try {
                   // upload received file(s)
                   $upload->receive();
               } catch (Zend_File_Transfer_Exception $e) {
                   $e->getMessage();
               }

                $image = $form->getValues();
                Zend_Debug::dump($image, 'image');
                $image = $upload->getFileName('image');
*/

/*
                // so, Finally lets See the Data that we received on Form Submit
                $uploadedData = $form->getValues();
                Zend_Debug::dump($uploadedData, 'Form Data:');

                // you MUST use following functions for knowing about uploaded file
                # Returns the file name for 'doc_path' named file element
                $image = $upload->getFileName('image');
*/
              //  $image = $form->getValue('image');

                $build = $form->getValue('build');
                $address_id = $form->getValue('address_id');
                $gps = $form->getValue('gps');
                $telephone = $form->getValue('telephone');
                $description = $form->getValue('description');
                $establishmenttype_id= $form->getValue('establishmenttype_id');

                $establishments = new Application_Model_DbTable_Establishments();
                $establishments->updateEstablishments($id, $title, $image, $build, $address_id, $gps, $telephone, $description, $establishmenttype_id);



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
        // Отримання id потрібного елемента

        $id = $this->_getParam('id', 0);
        if ($id > 0) {
            // Створюємо об'єкт моделі
            $establishments = new Application_Model_DbTable_Establishments();

            // Заповнюємо форму за допомогою метода populate
            $form->populate($establishments->getEstablishment($id));

        }
            $establishment_id = $this->_getParam('id', 0);
            if ($establishment_id > 0) {
                // Створюємо об'єкт моделі
                $worktime = new Application_Model_DbTable_Worktime();
		          // Заповнюємо форму за допомогою метода populate
                $form->populate($worktime->getWorktime($establishment_id));

            }

    }
//        print_r($image = $form->file->getFileName('image'));

        //die(print_r($upload));
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
                $worktime = new Application_Model_DbTable_Worktime();
                $worktime->deleteWorktime($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $establishments = new Application_Model_DbTable_Establishments();
            $this->view->establishments = $establishments->getEstablishmentsToDel($id);
            $worktime= new Application_Model_DbTable_Worktime();
            $this->view->worktime = $worktime->getWorktimeToDel($id);
        }
    }

    public function establishmentaAction()
    {


        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    }

    public function establishmentcAction()
    {

        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    }
    public function establishmentfAction()
    {

        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    }
    public function establishmentnAction()
    {

        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    }
    public function establishmenttAction()
    {

        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    }
    public function establishmentAction()
    {

        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    /*    $id = $this->_getParam('id', 0);
        if ($id > 0) {
            // Створюємо об'єкт моделі
            $establishment = new Application_Model_DbTable_Establishments();

            // Заповнюємо форму за допомогою метода populate
            $establishment->getEstablishment($id);
            $this->view->establishment = $establishment;
        }*/
       // print_r($establishment);
        /*
        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;
      //  $this->_helper->redirector('establishment');
            // Отримання id потрібного елемента
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                // Створюємо об'єкт моделі
                $establishment = new Application_Model_DbTable_Establishments();

                // Заповнюємо форму за допомогою метода populate
                $establishment->getEstablishment($id);
                $this->view->establishment = $establishment;
            }
        //print_r($establishment);
     //   $this->_helper->redirector('establishments', 'establishment');

    */



    }

}