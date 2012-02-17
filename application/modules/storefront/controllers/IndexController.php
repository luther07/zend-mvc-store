<?php

class Storefront_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize controller here */
    }

    public function indexAction()
    {
        //action body
        $this->view->headTitle('Welcome', 'PREPEND');
    }

}
