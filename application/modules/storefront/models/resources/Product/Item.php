<?php

class Storefront_Resource_Product_Item extends SF_Model_Resource_Db_Table_Row_Abstract implements Storefront_Resource_Product_Item_Interface
{

    public function getImages()
    {
        return $this->findDependentRowset(
        'Storefront_Resource_ProductImage',
        'Image'
        );
    }

    public function getDefaultImage()
    {
        $row = $this->findDependentRowset(
        'Storefront_Resource_ProductImage',
        'Image',
        $this->select()
        ->where('isDefault = ?', 'Yes')
        ->limit(1)
        )->current();
        return $row;
    }

    public function getPrice($withDiscount=true,$withTax=true)
    {
        $price = $this->getRow()->price;
        if (true === $this->isDiscounted()
            && true === $withDiscount)
        {
            $discount = $this->getRow()->discountPercent;
            $discounted = ($price*$discount)/100;
            $price = round($price - $discounted, 2);
        }
        if (true === $this->isTaxable() && true === $withTax) {
            $taxService = new Storefront_Service_Taxation();
            $price = $taxService->addTax($price);
        }
        return $price;
    }

    public function isDiscounted()
    {
        return 0 == $this->getRow()->discountPercent ? false : true;
    }

    /* TODO: change type of taxable from string to boolean */
    public function isTaxable()
    {
        return 'Yes' == $this->getRow()->taxable ? true : false;
    }

}
