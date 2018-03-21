<?php
require_once("model/backend/UserManager.php");
require_once("model/backend/ConfigurationManager.php");

function createMember($user,$groupName){
    $userManager = new UserManager();
    $groupManager = new GroupManager();
    $configManager = new ConfigurationManager();

    $configManager->getConfigurationID('default');
    $registrationRes = $userManager->createMember($user,$groupManager->getGroupData($groupName));
    require("view/backend/listUsersView.php");
}

function createAdmin($admin){
    $userManager = new UserManager();
    $groupManager = new GroupManager();
    $registrationRes = $userManager->createAdmin($admin,$groupManager->getGroupData('Global administrators'));
    require("view/backend/listAdminsView.php");
}

function removeUser($name){
    $userManager = new UserManager();
    $result = $userManager->removeUser($userManager->getUserID($name));
    require("view/backend/listUsersView.php");
}
function removeAllUsers(){
    $userManager = new UserManager();
    $result = $userManager->removeAllUsers();
    require("view/backend/listUsersView.php");
}

function listUsers($query){
    $userManager = new UserManager();
    $listUsers = $userManager->getListUsers($query);
    require("view/backend/listUsersView.php");
}

function getUser($name){
    $userManager = new UserManager();
    $user = $userManager->getUser($userManager->getUserID($name));
//    print_r($user);
    require("view/backend/listUsersView.php");
}

function changeStatusMembers($listNames,$status){
    $userManager = new UserManager();
    $userManager->changeStatusMembers($listNames,$status);
}
