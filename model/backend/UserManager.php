<?php
require_once("load.php");                                                      
require_once("model/Manager.php");

class UserManager extends Manager
{

    /*
     *
     *@TODO: be more careful on the possible names : display/shortDisplay .. : force the display in the selection choice or consider all         naming options
     */
    public final function isGlobalAdmin($userDisplay)
    {
        $query = new stdclass();
        $query->roles = 'GLOBAL_ADMIN';
        $listAdmins = $this->getListUsers($query);
        foreach($listAdmins->pageItems as $adminItem){
            if($adminItem->display == $userDisplay){ //if current user is admin
                return true;
            }
        }
        return false;
    }

    public final function createMember($member,$group)
    {
        $userService = new Cyclos\UserService();
        $member->group = $group;
        return $userService->register($member);

    }

    public final function createAdmin($admin,$adminGroup)
    {
        $userService = new Cyclos\UserService();
        $currentUser = $userService->getCurrentUser();

        $admin->group = $adminGroup;
        if($this->isGlobalAdmin($currentUser->display)){ //if current user is admin
            return $userService->register($admin);
        }
        throw new Exception('Can\'t create new global admin : permission denied');
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

    /*
     *@TODO: be more rigurous on naming conditions, because the query can match several users
     */
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

    /*
     *@throws permissionDeniedException if $status is not 'active' & if the member is actually a global admin
     */
    public final function changeStatusMembers($listNames,$status)
    {
        $userStatusService = new Cyclos\UserStatusService();

        foreach($listNames as $name){
            $test = strcmp($status,'active');
            if(($test != 0) && ($this->isGlobalAdmin($name))){
                throw new Exception('Can\'t ' . $status . ' access to ' . $name . ' : global administrator ');
            }
            else{
                $userStatus = new stdclass();

                $userStatus->user = new stdclass();
                $userStatus->user->id = $this->getUserID($name);
                //$userStatus->id = $this->getUserID($name);
                $userStatus->user->display = $name;
                //                   $userStatus->status = new stdclass();
                $userStatus->status = $status;

                $userStatusService->changeStatus($userStatus);
            }
        }
    }

}
