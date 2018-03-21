<?php
require_once("load.php");                                                      
require_once("model/Manager.php");

class GroupManager extends Manager
{
    public final function createGroup($group)
    {
        $groupService = new Cyclos\GroupService();
        return $groupService->save($group);

    }

    public final function removeGroup($name)
    {
        $groupService = new Cyclos\GroupService();
        return $groupService->remove(getGroupID($name));
    }

    public final function removeAllGroups()
    {
        $groupService = new Cyclos\GroupService();
        $query = new stdclass();
        $query->name = 'Cairn';
        $res2 = $groupService->search($query);

        $groupService->removeAll();

    }
    public final function saveGroup($group)
    {
        $groupService = new Cyclos\GroupService();
        return $groupService->save($group);
    }

    public final function loadGroup($id)
    {
        $groupService = new Cyclos\GroupService();
        return $groupService->load($id);
    }

    public final function getGroupID($name)
    {
        return $this->getGroupData($name)->id;
    }

    public final function getGroupData($name)
    {
        $groupService = new Cyclos\GroupService();
        $query = new stdclass();
        $query->name = $name;
        $res = $groupService->search($query);
        return $res->pageItems[0];
    }
    public final function getListGroups()
    {
        $groupService = new Cyclos\GroupService();
        return $groupService->_list();
    }

}
