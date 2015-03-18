<?php

class WorktimeController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

   function indexAction()
    {
        $this->view->title = "Establishment work time";
        $this->view->headTitle($this->view->title);
        $worktime = new Application_Model_DbTable_Worktime();
        $this->view->worktime = $worktime->getWorktimeList();
    }
    function addAction()
    {
        $this->view->title = "Add new establishment work time";
        $this->view->headTitle($this->view->title);
        $form = new Application_Form_Worktime();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {
                $establishment_id = $form->getValue('establishment_id');
                $opening = $form->getValue('opening');
                $break_from = $form->getValue('break_from');
                $break_to = $form->getValue('break_to');
                $closing = $form->getValue('closing');
                $weekend = $form->getValue('weekend');
               $worktime= new Application_Model_DbTable_Worktime();
                $worktime->addWorktime($establishment_id, $opening, $break_from, $break_to, $closing, $weekend);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }
	public function editAction()
	{
		$form = new Application_Form_Worktime();
		$form->submit->setLabel('Edit');
		$this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
				$id = $form->getValue('id');
				$establishment_id = $form->getValue('establishment_id');
                $opening = $form->getValue('opening');
                $break_from = $form->getValue('break_from');
                $break_to = $form->getValue('break_to');
                $closing = $form->getValue('closing');
                $weekend = $form->getValue('weekend');
                $worktime = new Application_Model_DbTable_Worktime();
                $worktime->updateWorktime($id, $establishment_id, $opening, $break_from, $break_to, $closing, $weekend);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }else {
        // Отримання id потрібного елемента
            $establishment_id = $this->_getParam('id', 0);
        if ($establishment_id > 0) {
            // Створюємо об'єкт моделі
            $worktime = new Application_Model_DbTable_Worktime();
            
            // ЗАповнюємо форму за допомогою метода populate
            $form->populate($worktime->getWorktime($establishment_id));
        }
    }
	}
	
    public function deleteAction()
    {
        $this->view->title = "Delete establishment work time";
        $this->view->headTitle($this->view->title);
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $worktime = new Application_Model_DbTable_Worktime();
                $worktime->deleteWorktime($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $worktime = new Application_Model_DbTable_Worktime();
            $this->view->worktime = $worktime->getWorktimeToDel($id);
        }
    }

}

