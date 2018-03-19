<?php
require_once("load.php");                                                      
require_once("model/Manager.php");

class CurrencyManager extends Manager
{
    public final function createCurrency($currency)
    {
        $currencyService = new Cyclos\CurrencyService();
        return $currencyService->save($currency);

    }

    public final function removeCurrency($id)
    {
        $currencyService = new Cyclos\CurrencyService();
        return $currencyService->remove($id);
    }

    public final function getListCurrencies()
    {
        $currencyService = new Cyclos\CurrencyService();
        return $currencyService->_list();
    }

}
