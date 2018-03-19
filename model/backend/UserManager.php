<?php
require_once("load.php");                                                      
require_once("model/Manager.php");

class UserManager extends Manager
{
    public final function createUser($user)
    {
        $userService = new Cyclos\UserService();
        return $userService->register($user);

    }

    public final function removeUser($id)
    {
        $userService = new Cyclos\UserService();
        return $userService->remove($id);
    }

    public final function removeAllUsers()
    {
        $userService = new Cyclos\UserService();
        $query = new stdclass();
        $query->name = 'Cairn';
        $res2 = $userService->search($query);

        $userService->removeAll();

    }

    public final function getUserID($name)
    {
        $userService = new Cyclos\UserService();
        $query = new stdclass();
        $query->keywords = $name;
        $res = $userService->search($query);
        return $res->pageItems[0]->id;
    }
    public final function getListUsers($query)
    {
        $userService = new Cyclos\UserService();
        return $userService->search($query);
    }

    public final function getUser($id)
    {
         $userService = new Cyclos\UserService();
         return $userService->load($id);
    }


}
