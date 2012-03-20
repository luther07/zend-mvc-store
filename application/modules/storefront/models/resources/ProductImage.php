<?php

//I don't know if our autoloader will automatically load classes that Zend_Db_Table needs (dependencies)

class Storefront_Resource_ProductImage extends SF_Model_Resource_Db_Table_Abstract implements Storefront_Resource_ProductImage_Interface{
    protected $_name = 'productImage' ;
    protected $_primary = 'imageId' ;
    protected $_rowClass = 'Storefront_Resource_ProductImage_Item';
    protected $_referenceMap = array(
        'Image' => array(
            'columns' => 'productId',
            'refTableClass' => 'Storefront_Resource_Product',
            'refColumns' => 'productId')
    );
}
