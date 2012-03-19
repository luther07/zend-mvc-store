<?php

//I don't know if our autoloader will automatically load classes that Zend_Db_Table needs (dependencies)
if (!class_exists('SF_Model_Resource_Db_Table_Row_Abstract')) {
    require_once APPLICATION_PATH . '/../library/SF/Model/Resource/Db/Table/Row/Abstract.php' ;
}

class Storefront_Resource_Category_Item extends SF_Model_Resource_Db_Table_Row_Abstract
    implements Storefront_Resource_Category_Item_Interface
{
    public function getParentCategory()
    {
        return $this->findParentRow('Storefront_Resource_Category', 'SubCategory') ;
    }
}
