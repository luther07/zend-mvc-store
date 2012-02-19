<?php

class Storefront_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize controller here */
        Zend_Registry::get('log')->info('Bootstrap ' . __METHOD__);
    }

    public function indexAction()
    {
        //action body
        $this->view->headTitle('Welcome', 'PREPEND');
        Zend_Registry::get('log')->info('Bootstrap ' . __METHOD__);
    }

}
