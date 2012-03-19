<?php

class Storefront_ErrorController extends Zend_Controller_Action
{

    public function errorAction()
    {
        Zend_Registry::get('log')->info('ErrorController ' . __METHOD__);


        $errors = $this->_getParam('error_handler');

        switch ($errors->type) {

            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:

                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = 'Page not found';
                break;
            case 'SF_Exception_404':
                // send 404
                $this->getResponse()
                    ->setRawHeader('HTTP/1.1 404 Not Found');
                $this->view->message = $errors->exception->getMessage();
                break;
            default:
                //application error
                //$this->getResponse()->setHttpResponseCode(500);
                //$this->view->message = 'Application error';
                //new
                // application error; display error page, but don't change status code
                // Log the exception
                $exception = $errors->exception ;
                $log = new Zend_Log(new Zend_Log_Writer_Stream(
                           '/tmp/applicationException.log')
                );
                $log->debug($exception->getMessage() . "\n" .
                            $exception->getTraceAsString()) ;
                break;
        }

        // Log exception, if logger available
        if ($log = $this->getLog()) {
            $log->crit($this->view->message, $errors->exception);
        }

        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }

        $this->view->request = $errors->request;
        Zend_Registry::get('log')->info('ErrorController ' . __METHOD__);

    }

    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasPluginResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        Zend_Registry::get('log')->info('ErrorController ' . __METHOD__);
        return $log;
    }

}
