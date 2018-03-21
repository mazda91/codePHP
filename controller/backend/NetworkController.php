<?php
require("model/backend/NetworkManager.php");

function createNetwork($network,$data){
    $networkManager = new NetworkManager();
    $idNetwork = $networkManager->createNetwork($network,$data);
    require("view/backend/listNetworksView.php");
}

function getNetwork($name){
    $networkManager = new NetworkManager();
    $network = $networkManager->getNetwork($name);
}

function switchNetwork($name){
    $networkManager = new NetworkManager();

    if ($name == 'globalAdmin'){
        $internalName = 'global';
    }
    else{
        $network = $networkManager->getNetwork($name);
        $internalName = $network->dto->internalName;
    }
    Cyclos\Configuration::setRootUrl('http://127.0.0.1:8080/cyclos/' . $internalName);
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
