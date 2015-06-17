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
                $imagearray = $form->image2->getFileName(null, false);
                $image="";
                $last_key = end(array_keys($imagearray));
                foreach($imagearray as $key => $value){
                    if($key == $last_key){
                        $image = $image . $value;
                    }else{
                        $image = $image . $value . ',';
                    }
                }

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

                if($form->getValue('image2')!= "")
                {
                    $image = $form->getValue('image2');
                } else {
                    $image = $form->getValue('image');
                }
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

    public function ehotelsAction()
    {

        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('1', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('1');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;

    }

    public function emotelsAction()
    {

        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('2', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('2');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;


    }
    public function eapartmentsAction()
    {


        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('3', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('3');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;


    }
    public function ehostelsAction()
    {


        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('4', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('4');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }
    public function establishmentcAction()
    {

        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    }
    public function emonumentsAction()
    {

        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('1', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('1');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }
    public function emuseumsAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('2', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('2');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }

    public function etheatresAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('3', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('3');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }

    public function ephilarmonicsAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('4', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('4');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }
    public function efairsAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('5', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('5');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }
    public function eexhibitionsAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('6', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('6');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;

    }

    public function eculturalplacesAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('7', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('7');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }
    public function elibrariesAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('8', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('8');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }
    public function establishmentfAction()
    {
        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    }
    public function eclubsAction()
    {

        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('1', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('1');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;

    }

    public function eentertaimentcentersAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('2', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('2');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }

    public function ecinemasAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('3', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('3');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }

    public function esportsAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('4', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('4');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }
    public function eshoppingsAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('5', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('5');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }
    public function establishmentnAction()
    {

        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    }
    public function erestaurantsAction()
    {

        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('1', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('1');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;

    }

    public function ebarsAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('2', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('2');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }

    public function epubsAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('3', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('3');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }

    public function epizzeriasAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('4', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('4');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }
    public function ecafesAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('5', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('5');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }

    public function ecanteensAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('6', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('6');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }

    public function efastfoodsAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('7', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('7');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }

    public function establishmenttAction()
    {

        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentsList();
        $this->view->establishments = $establishmentsList;

    }
    public function erailwaystationsAction()
    {

        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('1', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('1');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;

    }

    public function ebusstationsAction()
    {
       $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('2', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('2');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }

    public function eairportsAction()
    {
        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('3', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('3');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;
    }

    public function epublictransportationsAction()
    {

        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('4', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('4');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;


    }
    public function erentacarsAction()
    {

        $offset = $this->_getParam('offset', 0);
        $establishments = new Application_Model_DbTable_Establishments();
        if ($offset) {
            $establishmentsList = $establishments->getEstablishmentsList('5', $offset);
        } else {
            $establishmentsList = $establishments->getEstablishmentsList('5');
        }
        $this->_helper->layout()->disableLayout();
        $this->view->offset = $offset;
        $this->view->establishments = $establishmentsList;

    }

    public function establishmentAction()
    {

        $id = $this->_getParam('id', 0);
        if ($id > 0) {
            // Створюємо об'єкт моделі
            $establishment = new Application_Model_DbTable_Establishments();

            // Заповнюємо форму за допомогою метода populate
            $establishment->getEstablishment($id);
            $this->view->establishment = $establishment;

        }
        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentRow($id);
        $this->view->establishments = $establishmentsList;


        $comments = new Application_Model_DbTable_Comments();
        $commentsList = $comments->getCommentsList($id);
        $this->view->comments = $commentsList;

        $this->view->title = "Add new Comment";
        $this->view->headTitle($this->view->title);
        $form = new Application_Form_Comments();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $establishment_id = $this->_getParam('id', 1);
                $username = $form->getValue('username');
                $comment = $form->getValue('comment');
                $comments = new Application_Model_DbTable_Comments();
                $comments->addComments($establishment_id, $username, $comment);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function walkthecityAction()
    {

        $id = $this->_getParam('id', 0);
        if ($id > 0) {
            // Створюємо об'єкт моделі
            $establishment = new Application_Model_DbTable_Establishments();

            // Заповнюємо форму за допомогою метода populate
            $establishment->getEstablishment($id);
            $this->view->establishment = $establishment;

        }
        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getEstablishmentRow($id);
        $this->view->establishments = $establishmentsList;
    }


    public function randomAction()
    {
        $this->_helper->layout()->disableLayout();
        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getrandomList();
        $this->view->establishments = $establishmentsList;


    }
    public function newestAction()
    {

        $this->_helper->layout()->disableLayout();
        $establishments = new Application_Model_DbTable_Establishments();
        $establishmentsList = $establishments->getnewestList();
        $this->view->establishments = $establishmentsList;


    }

}

