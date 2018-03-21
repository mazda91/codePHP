<?php
require_once("load.php");                                                      
require_once("model/Manager.php");

class AccountManager extends Manager
{
    public final function createAccount($product,$groupID)
    {
        $productService = new Cyclos\ProductsUserService();

        $owner = new stdclass();
        $owner->id = $groupID;
        return $productService->assign($product,$owner);

    }

    public final function removeAccount($name)
    {
        $accountService = new Cyclos\AccountService();
        return $accountService->remove(getAccountID($name));
    }

    public final function removeAllAccounts()
    {
        $accountService = new Cyclos\AccountService();
        $query = new stdclass();
        $query->name = 'Cairn';
        $res2 = $accountService->search($query);

        $accountService->removeAll();

    }
    public final function saveAccount($account)
    {
        $accountService = new Cyclos\AccountService();
        return $accountService->save($account);
    }

    public final function loadAccount($id)
    {
        $accountService = new Cyclos\AccountService();
        return $accountService->load($id);
    }

    public final function getAccountID($name)
    {
        return $this->getAccountData($name)->id;
    }

    public final function getAccountData($name)
    {
        $accountService = new Cyclos\AccountService();
        $query = new stdclass();
        $query->name = $name;
        $res = $accountService->search($query);
        return $res->pageItems[0];
    }
    public final function getListAccounts()
    {
        $accountService = new Cyclos\AccountService();
        return $accountService->_list();
    }

}
