<?php
require_once("model/backend/AccountManager.php");

function createAccount($product,$groupName){
    $accountManager = new AccountManager();
    $groupManager = new GroupManager();

    $groupID = $groupManager->getGroupID($groupName);
    $account = $accountManager->createAccount($product,$groupID);
    require("view/backend/listAccountsView.php");
}
function removeAccounts($accountNames){
    $accountManager = new AccountManager();
    $userManager = new UserManager();

    foreach($accountNames as $accountName){
        $query = new stdclass();
        $query->name = $accountName;
        $users = $userManager->getListUsers($query);
        foreach($users->pageItems as $user){
            echo $user->shortDisplay;
        }

        if(!empty($users)){
            print_r($users);
            throw new Exception('Can\'t remove account' . $accountName . ' : not empty');
            ;
        }
        else{
            removeAccount($accountName);
        }
    }
    require("view/backend/listAccountsView.php");
}
function removeAllAccounts(){
    $accountManager = new AccountManager();
    $result = $accountManager->removeAllAccounts();
    require("view/backend/listAccountsView.php");
}

function listAccounts(){
   $accountManager = new AccountManager();
   $listAccounts = $accountManager->getListAccounts();
   require("view/backend/listAccountsView.php");
}

function accountID($accountName){
    $accountManager = new AccountManager();
    return $accountManager->getAccountID($accountName);  
}

function accountData($accountName){
    $accountManager = new AccountManager();
    return $accountManager->getAccountData($accountName);
}

function modifyAccount($idAccount){
   $accountManager = new AccountManager();
   $account = $accountManager->loadAccount($idAccount); 
   //print_r($account);
   $account->adminType = 'networks';
   $account->nature = 'memberAccount';
  // print_r($account);
   $accountManager->saveAccount($account);
   require("view/backend/listAccountsView.php");
}
