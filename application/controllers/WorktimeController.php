<?php

class WorktimeController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('admin');
    }

   function indexAction()
    {
        $this->view->title = "Establishment work time";
        $this->view->headTitle($this->view->title);

        $worktime = new Application_Model_DbTable_Worktime();
        $this->view->worktime = $worktime->getWorktimeList();
    }

}

