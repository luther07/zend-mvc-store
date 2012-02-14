<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize controller here */
    }

    public function indexAction()
    {
        //action body
        $this->view->assign('title', 'Hello World!');
    }

}
