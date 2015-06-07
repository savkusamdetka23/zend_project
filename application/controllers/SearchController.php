<?php

class SearchController extends Zend_Controller_Action {

    public function updateindexAction() {

        $model = new Application_Model_DbTable_Search();
        $model->updateIndex();
    }

    public function searchAction() {
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('search/controls.phtml');
        $this->view->paginationControl = new Zend_View_Helper_PaginationControl();
        $model = new Application_Model_DbTable_Search();
        $this->view->query = $this->_getParam('query');
        $this->view->hits = $model->search($this->view->query);
        $paginator = Zend_Paginator::factory($this->view->hits);
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));
        $paginator->query = $this->_getParam('query');
        $paginator->setItemCountPerPage(3);

        $this->view->paginator = $paginator;
    }



}