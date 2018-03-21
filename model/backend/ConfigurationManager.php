<?php
require_once("load.php");                                                      
require_once("model/Manager.php");

class ConfigurationManager extends Manager
{
    public final function createConfig($config)
    {
        $configurationService = new Cyclos\ConfigurationService();
        //check that public registration is enabled

        return $configurationService->register($member);

    }

    public final function removeConfiguration($id)
    {
        $configurationService = new Cyclos\ConfigurationService();
        return $configurationService->remove($id);
    }

    public final function removeAllConfigurations()
    {
        $configurationService = new Cyclos\ConfigurationService();
        $query = new stdclass();
        $query->name = 'Cairn';
        $res2 = $configurationService->search($query);

        $configurationService->removeAll();

    }

    public final function getConfigurationID($name)
    {
        $configurationService = new Cyclos\ConfigurationService();
        if ($name == 'default'){
            print_r($configurationService->getDefault());
            return $configurationService->getDefault()->id;
        }
        else{
            return $this->getConfiguration($name)->id;
        }
    }
    public final function getListConfigurations()
    {
        $configurationService = new Cyclos\ConfigurationService();
        return $configurationService->_list();
    }

    public final function getConfiguration($name)
    {
         $configurationService = new Cyclos\ConfigurationService();
         $listOfConfigs = $this->getListConfigurations();
         foreach($listOfConfigs as $config){
            if($config->name == $name){
                return $config;
            }
         }
         throw new Exception('Configuration ' . $name . ' not found '); 
    }


}
