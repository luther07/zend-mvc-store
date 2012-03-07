<?php

class Storefront_Resource_ProductImage_Item extends SF_Model_Resource_Db_Table_Row_Abstract implements Storefront_Resource_ProductImage_Item_Interface
{

    public function getThumbnail()
    {
        return $this->getRow()->thumbnail;
    }

    public function getFull()
    {
        return $this->getRow()->full;
    }

    public function isDefault()
    {
        return 'Yes' === $this->getRow()->isDefault ? true : false;
    }

}
