<?php
require("model/backend/NetworkManager.php");

function createNetwork($network,$data){
    $networkManager = new NetworkManager();
    $idNetwork = $networkManager->createNetwork($network,$data);
    require("view/backend/listNetworksView.php");
}
function removeNetwork($name){
    $networkManager = new NetworkManager();
    $result = $networkManager->removeNetwork($networkManager->getNetworkID($name));
    require("view/backend/listNetworksView.php");
}
function removeAllNetworks(){
    $networkManager = new NetworkManager();
    $result = $networkManager->removeAllNetworks();
    require("view/backend/listNetworksView.php");
}

function listNetworks(){
   $networkManager = new NetworkManager();
   $listNetworks = $networkManager->getListNetworks();
   require("view/backend/listNetworksView.php");
}
