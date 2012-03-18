<?php

//I don't know if our autoloader will automatically load classes that Zend_Db_Table needs (dependencies)
if (!class_exists('Storefront_Resource_ProductImage')) {
    require_once dirname(__FILE__) . '/ProductImage.php' ;
}
if (!class_exists('Storefront_Resource_Product_Item')) {
    require_once dirname(__FILE__) . '/Product/Item.php' ;
}

class Storefront_Resource_Product extends SF_Model_Resource_Db_Table_Abstract implements Storefront_Resource_Product_Interface {
    protected $_name = 'product' ;
    protected $_primary = 'productId' ;
    protected $_rowClass = 'Storefront_Resource_Product_Item' ;

    public function getProductById($id)
    {
        return $this->find($id)->current();
    }

    public function getProductByIdent($ident)
    {
        return $this->fetchRow(
        $this->select()->where('ident = ?', $ident)
        );
    }

    public function getProductsByCategory($categoryId, $paged=null, $order=null)
    {
        $select = $this->select();
        $select->from('product')
        ->where("categoryId IN(?)", $categoryId);
        if (true === is_array($order)) {
            $select->order($order);
        }
        if (null !== $paged) {
            $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
            $count = clone $select;
            $count->reset(Zend_Db_Select::COLUMNS);
            $count->reset(Zend_Db_Select::FROM);
            $count->from(
                'product',
                new Zend_Db_Expr(
                    'COUNT(*) AS `zend_paginator_row_count`'
                )
            );
            $adapter->setRowCount($count);
            $paginator = new Zend_Paginator($adapter);
            $paginator->setItemCountPerPage(5)
            ->setCurrentPageNumber((int) $paged);
            return $paginator;
        }
        return $this->fetchAll($select);
    }

    public function saveProduct($info)
    {
    }

}
