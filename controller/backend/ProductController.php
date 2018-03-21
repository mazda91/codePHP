<?php
require_once("model/backend/ProductManager.php");

function createProduct($product){
    $productManager = new ProductManager();
    $product = $productManager->createProduct($product);
    require("view/backend/listProductsView.php");
}
function removeProducts($productNames){
    $productManager = new ProductManager();
    $userManager = new UserManager();

    foreach($productNames as $productName){
        $query = new stdclass();
        $query->name = $productName;
        $users = $userManager->getListUsers($query);
        foreach($users->pageItems as $user){
            echo $user->shortDisplay;
        }

        if(!empty($users)){
            print_r($users);
            throw new Exception('Can\'t remove product' . $productName . ' : not empty');
            ;
        }
        else{
            removeProduct($productName);
        }
    }
    require("view/backend/listProductsView.php");
}
function removeAllProducts(){
    $productManager = new ProductManager();
    $result = $productManager->removeAllProducts();
    require("view/backend/listProductsView.php");
}

function listProducts(){
   $productManager = new ProductManager();
   $listProducts = $productManager->getListProducts();
   require("view/backend/listProductsView.php");
}

function productID($productName){
    $productManager = new ProductManager();
    return $productManager->getProductID($productName);  
}

function productData($productName,$ownerName){
    $productManager = new ProductManager();
    $groupManager = new GroupManager();

    $ownerID = $groupManager->getGroupID($ownerName);
    $channel = Cyclos\Configuration::getChannel();
    return $productManager->getProductData($ownerID,$channel);
}

function modifyProduct($idProduct){
   $productManager = new ProductManager();
   $product = $productManager->loadProduct($idProduct); 
   //print_r($product);
   $product->adminType = 'networks';
   $product->nature = 'memberProduct';
  // print_r($product);
   $productManager->saveProduct($product);
   require("view/backend/listProductsView.php");
}
