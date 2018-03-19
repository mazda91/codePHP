<?php
require_once("model/backend/GroupManager.php");
require_once("model/backend/UserManager.php");

function createGroup($group){
    $groupManager = new GroupManager();
    $idGroup = $groupManager->createGroup($group);
    require("view/backend/listGroupsView.php");
}
function removeGroups($groupNames){
    $groupManager = new GroupManager();
    $userManager = new UserManager();

    foreach($groupNames as $groupName){
        $query = new stdclass();
        $query->name = $groupName;
        $users = $userManager->getListUsers($query);
        foreach($users->pageItems as $user){
            echo $user->shortDisplay;
        }

        if(!empty($users)){
            print_r($users);
            throw new Exception('Can\'t remove group' . $groupName . ' : not empty');
            ;
        }
        else{
            removeGroup($groupName);
        }
    }
    require("view/backend/listGroupsView.php");
}
function removeAllGroups(){
    $groupManager = new GroupManager();
    $result = $groupManager->removeAllGroups();
    require("view/backend/listGroupsView.php");
}

function listGroups(){
   $groupManager = new GroupManager();
   $listGroups = $groupManager->getListGroups();
   require("view/backend/listGroupsView.php");
}

function groupID($groupName){
    $groupManager = new GroupManager();
    return $groupManager->getGroupID($groupName);  
}

function groupData($groupName){
    $groupManager = new GroupManager();
    return $groupManager->getGroupData($groupName);
}

function modifyGroup($idGroup){
   $groupManager = new GroupManager();
   $group = $groupManager->loadGroup($idGroup); 
   //print_r($group);
   $group->adminType = 'networks';
   $group->nature = 'memberGroup';
  // print_r($group);
   $groupManager->saveGroup($group);
   require("view/backend/listGroupsView.php");
}
