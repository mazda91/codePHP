<?php
require_once("model/backend/UserManager.php");

function createUser($user){
    $userManager = new UserManager();
    $registrationRes = $userManager->createUser($user);
    require("view/backend/listUsersView.php");
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
   print_r($user->group);
   require("view/backend/listUsersView.php");
}
