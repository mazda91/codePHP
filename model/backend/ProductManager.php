<?php
require_once("load.php");                                                      
require_once("model/Manager.php");

class ProductManager extends Manager
{
    public final function createProduct($product,$type)
    {
        $productService = new Cyclos\ProductsUserService();

        return $productService->assign($product,$group);

    }

    public final function removeProduct($name)
    {
        $productService = new Cyclos\ProductService();
        return $productService->remove(getProductID($name));
    }

    public final function removeAllProducts()
    {
        $productService = new Cyclos\ProductService();
        $query = new stdclass();
        $query->name = 'Cairn';
        $res2 = $productService->search($query);

        $productService->removeAll();

    }
    public final function saveProduct($product)
    {
        $productService = new Cyclos\ProductService();
        return $productService->save($product);
    }

    public final function loadProduct($id)
    {
        $productService = new Cyclos\ProductService();
        return $productService->load($id);
    }

    public final function getProductID($name)
    {
        return $this->getProductData($name)->id;
    }

    public final function getProductData($ownerID,$channel)
    {
        $productService = new Cyclos\ProductsGroupService();

        $owner = new stdclass();
        $owner->id = $ownerID;
        return $productService->getActiveProducts($owner,$channel,NULL);
    }
    public final function getListProducts()
    {
        $productService = new Cyclos\ProductService();
        return $productService->_list();
    }

}
