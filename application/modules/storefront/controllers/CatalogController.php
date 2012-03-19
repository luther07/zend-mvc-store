<?php

class Storefront_CatalogController extends Zend_Controller_Action
{
    protected $_catalogModel;

    public function init()
    {
        Zend_Registry::get('log')->info('CatalogController ' . __METHOD__);
        $this->_catalogModel = new Storefront_Model_Catalog();
    }

    public function indexAction()
    {
        $cident = $this->_getParam('categoryIdent', 0) ;
        Zend_Registry::get('log')->info('CatalogController ' . __METHOD__) ;
        Zend_Registry::get('log')->info('CatalogController with  categoryIdent arg ' . $cident ) ;
        $products = $this->_catalogModel->getProductsByCategory(
            $this->_getParam('categoryIdent', 0),
            $this->_getParam('page', 1), array('name')
        );
        $category = $this->_catalogModel
                         ->getCategoryByIdent(
                             $this->_getParam('categoryIdent', '')
                           );
        if (null === $category) {
            throw new SF_Exception_404(
                'Unknown category ' . $this->_getParam('categoryIdent')
            );
        }
        $subs = $this->_catalogModel
                     ->getCategoriesByParentId($category->categoryId
                       );
        $this->getBreadcrumb($category);
        Zend_Registry::get('log')->info('retrn from getBreadcrubm') ;
        $this->view->assign(array(
                         'category' => $category,
                         'subCategories' => $subs,
                         'products' => $products)
                     );
        Zend_Registry::get('log')->info('last line of indexAction') ;
    }

    public function viewAction()
    {
        Zend_Registry::get('log')->info('CatalogController ' . __METHOD__);
        $product = $this->_catalogModel->getProductByIdent(
            $this->_getParam('productIdent', 0)
            );
        if (null === $product) {
            throw new SF_Exception_404('Unknown product ' . $this->_getParam('productIdent'));
        }
        $category = $this->_catalogModel
                         ->getCategoryByIdent(
                             $this->_getParam('categoryIdent', '')
                           );
        $this->getBreadcrumb($category);
        $this->view->assign(array('product' => $product));
    }

    public function getBreadcrumb($category)
    {
        Zend_Registry::get('log')->info('CatalogController ' . __METHOD__);
        $this->view->bread = $this->_catalogModel
                                  ->getParentCategories($category);
        Zend_Registry::get('log')->info('super breadcrumbs') ;
    }
}
