<?php

class Zend_View_Helper_Breadcrumb extends Zend_View_Helper_Abstract
{
    public function breadcrumb($product = null)
    {
        if ($this->view->bread) {
            $bread = $this->view->bread;
            $crumbs = array();
            $bread = array_reverse($bread);
            foreach ($bread as $category) {
                $href = $this->view->url(array(
                            'categoryIdent' => $category->ident,
                            ),
                            'catalog_category'
                );
                $crumbs[] = '<a href="' . $href . '">' .
                $this->view->Escape($category->name) . '</a>';
            }
            if (null !== $product) {
                $crumbs[] = $this->view->Escape($product->name);
            }
            return join(' &raquo; ', $crumbs);
        }
    }
}
