<?php
require("model/backend/CurrencyManager.php");

function createCurrency($currency){
    $currencyManager = new CurrencyManager();
    $result = $currencyManager->createCurrency($currency);
    require("view/backend/listCurrenciesView.php");
}
function removeCurrency($id){
    $currencyManager = new CurrencyManager();
    $result = $currencyManager->removeCurrency($id);
    require("view/backend/listCurrenciesView.php");
}

function listCurrencies(){
   $currencyManager = new CurrencyManager();
   $listCurrencies = $currencyManager->getListCurrencies();
   require("view/backend/listCurrenciesView.php");
}
