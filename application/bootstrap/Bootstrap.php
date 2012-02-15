<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
public $frontController;
protected function _initLocale()
{
  $locale = new Zend_Locale('en_GB');
  Zend_Registry::set('Zend_Locale', $locale);
}
protected function _initViewSettings()
{
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
}

