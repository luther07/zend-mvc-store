<?php

interface Storefront_Resource_Category_Interface
{
    public function getCategoriesByParentId($parentId) ;
    public function getCategoryByIdent($ident) ;
    public function getCategoryById($id) ;
}
