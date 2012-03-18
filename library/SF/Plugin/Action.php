<?php

class SF_Plugin_Action extends Zend_Controller_Plugin_Abstract
{
    protected $_stack;
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        $stack = $this->getStack();
        // category menu
        $categoryRequest = new Zend_Controller_Request_Simple();
        $categoryRequest->setControllerName('category')
                        ->setActionName('index')
                        ->setParam(
                         'responseSegment',
                         'categoryMain'
                         );
        // push requests into the stack
        $stack->pushStack($categoryRequest);
    }
    public function getStack()
    {
        if (null === $this->_stack) {
            $front = Zend_Controller_Front::getInstance();
            if (!$front->hasPlugin('Zend_Controller_Plugin_ActionStack')) {
                $stack = new Zend_Controller_Plugin_ActionStack();
                $front->registerPlugin($stack);
            } else {
                $stack = $front->getPlugin('Zend_Controller_Plugin_ActionStack');
            }
            $this->_stack = $stack;
        }
    return $this->_stack;
    }
}
