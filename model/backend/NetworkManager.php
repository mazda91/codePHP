<?php
require_once("load.php");                                                      
require_once("model/Manager.php");

class NetworkManager extends Manager
{
    public final function createNetwork($network,$data)
    {
        $networkService = new Cyclos\NetworkService();
        return $networkService->createWithData($network,$data);

    }

    public final function removeNetwork($id)
    {
        $networkService = new Cyclos\NetworkService();
        return $networkService->remove($id);
    }

    public final function removeAllNetworks()
    {
        $networkService = new Cyclos\NetworkService();
        $query = new stdclass();
        $query->name = 'Cairn';
        $res2 = $networkService->search($query);

        $networkService->removeAll();

    }

    public final function getNetworkID($name)
    {
        $networkService = new Cyclos\NetworkService();
        $query = new stdclass();
        $query->name = $name;
        $res = $networkService->search($query);
        return $res->pageItems[0]->id;
    }
    public final function getListNetworks()
    {
        $networkService = new Cyclos\NetworkService();
        return $networkService->_list();
    }

}
