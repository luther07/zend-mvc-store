<?php

class Storefront_CategoryController extends Zend_Controller_Action
{
    public function indexAction()
    {
        Zend_Registry::get('log')->info('CategoryController ' . __METHOD__);
        $id = $this->_getParam('categoryId', 0);
        $catalogModel = new Storefront_Model_Catalog();
        $this->view->categories = $catalogModel->getCategoriesByParentId($id);
        $this->_helper
             ->viewRenderer
             ->setResponseSegment(
                   $this->_getParam('responseSegment')
               );
    }
}
