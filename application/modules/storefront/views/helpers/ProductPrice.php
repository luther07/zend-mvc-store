<?php

class Zend_View_Helper_ProductPrice extends Zend_View_Helper_Abstract
{
    public function productPrice(Storefront_Resource_Product_Item $product)
    {
        $currency = new Zend_Currency();
        $formatted = $currency->toCurrency($product->getPrice());
        if ($product->isDiscounted()) {
            $formatted .= ' was <del>' . $currency-> toCurrency($product->getPrice(false)) . '</del>';
        }
        return $formatted;
    }
}
