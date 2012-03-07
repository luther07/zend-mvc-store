<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public $frontController;

    protected function _initLogging()
    {
        $this->bootstrap('frontController');
        $logger = new Zend_Log();
        if (APPLICATION_ENV == 'production')
            $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/../data/logs/app.log');
        else
            $writer = new Zend_Log_Writer_Firebug();
        $logger->addWriter($writer);
        if ('production' == $this->getEnvironment()) {
            $filter = new Zend_Log_Filter_Priority(Zend_Log::CRIT);
            $logger->addFilter($filter);
        }
        Zend_Registry::set('log', $logger);
    }

    protected function _initDefaultModuleAutoloader()
    {
        Zend_Registry::get('log')->info('Bootstrap ' . __METHOD__);
        $this->_resourceLoader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Storefront',
            'basePath' => APPLICATION_PATH .
            '/modules/storefront'));
        $this->_resourceLoader->addResourceTypes(array(
            'modelResource' => array(
            'path' => 'models/resources',
            'namespace' => 'Resource'),
            'service' => array(
            'path' => 'services',
            'namespace' => 'Service')
            ));
    }

    protected function _initLocale()
    {
        Zend_Registry::get('log')->info('Bootstrap ' . __METHOD__);
        $locale = new Zend_Locale('en_GB');
        Zend_Registry::set('Zend_Locale', $locale);
    }

    protected function _initViewSettings()
    {
        Zend_Registry::get('log')->info('Bootstrap ' . __METHOD__);
        $this->bootstrap('view');
        $this->_view = $this->getResource('view');
        // set encoding and doctype
        $this->_view->setEncoding('UTF-8');
        $this->_view->doctype('XHTML1_STRICT');
        // set the content type and language
        $this->_view
        ->headMeta()
        ->appendHttpEquiv(
        'Content-Type', 'text/html; charset=UTF-8'
        );
        $this->_view
        ->headMeta()
        ->appendHttpEquiv('Content-Language', 'en-US');
        // set css links
        $this->_view
        ->headStyle()
        ->setStyle('@import "/css/access.css";');
        $this->_view
        ->headLink()
        ->appendStylesheet('/css/reset.css');
        $this->_view
        ->headLink()
        ->appendStylesheet('/css/main.css');
        $this->_view
        ->headLink()
        ->appendStylesheet('/css/form.css');
        // setting the site in the title
        $this->_view->headTitle('Storefront');
        // setting a separator string for segments:
        $this->_view->headTitle()->setSeparator(' - ');
    }

    protected function _initDbProfiler()
    {
        Zend_Registry::get('log')->info('Bootstrap ' . __METHOD__);
        if ('production' !== $this->getEnvironment()) {
            $this->bootstrap('db');
            $profiler = new Zend_Db_Profiler_Firebug('All DB Queries');
            $profiler->setEnabled(true);
            $this->getPluginResource('db')
                 ->getDbAdapter()
                 ->setProfiler($profiler);
        }
    }
}

