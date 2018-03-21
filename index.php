<? 
require_once("load.php");
//require("controller/backend/CurrencyController.php");                               
require("controller/backend/NetworkController.php");
require("controller/backend/UserController.php");
require("controller/backend/GroupController.php");
require("controller/backend/AccountController.php");

try{                                                                           
    if(isset($_GET['service'])){
        if($_GET['service'] == 'network'){
            if($_GET['action'] == 'create'){
                $network = new stdclass();
                //                $network->NAME = $_POST['name'];
                $network->name = 'Test';
                $network->internalName = 'Test';
                $network->enabled = true;
                $data = new stdclass();
                $data->currencyName = 'euro';
                $data->currencySymbol = '€';
                $data->systemAccount = 'systemAccount';
                $data->adminAccount = 'adminAccount';
                createNetwork($network,$data);
            }
            elseif($_GET['action'] == 'remove'){
                removeNetwork('testCairn4');
            } 
            elseif($_GET['action'] == 'removeall'){
                removeAllNetworks();
            }
            elseif($_GET['action'] == 'list'){
                ;
            }
        }
        elseif($_GET['service'] == 'user'){
            if($_GET['action'] == 'create'){
                if(2==2){ //@TODO : check that all fields are valid    
                    $user = new stdclass();
                    $user->email = 'fournilNotreDame@hotmail.fr';  
                    $user->username = 'leFournil';
                    $user->name = $user->username;
                    $user->login = $user->username;
                    $user->hideEmail = true;
                    $user->skipActivationEmail = true;

                    $password = new stdclass();
                    $password->assign = true;
                    $password->value = 'pain';
                    $password->confirmationValue = 'pain';
                    $password->forceChange = true;
                    $user->passwords = $password;
                    //                      $user->loginPassword ="pain";
                    //$user->assign = true;
                    if($_GET['status'] == 'admin'){//by default, the group is 'Global administrators'
                        createAdmin($user);
                    }
                    else{//if not admin then user
                        $groupName = 'Test2';
                        createMember($user,$groupName);
                    }
                }
                else{//some invalid fields
                    throw new Exception("Error : invalid fields given");
                } 
            }
            elseif($_GET['action'] == 'get'){
                if(2==2){ //@TODO : check that all fields are valid
                    $name = 'painAuBeurre'; 
                    getUser($name);
                }
            }
            elseif($_GET['action'] == 'changeStatus'){
                if(2==2){ //@TODO : check that all fields are valid
                    $listNames = array('elefan'); 
                    changeStatusMembers($listNames,$_GET['status']);
                }
            }
        }
        elseif($_GET['service'] == 'account'){
            if($_GET['action'] == 'create'){
                if(2==2){ //@TODO : check that all fields are valid
                   createAccount($product); 
                }
            }
        }
        elseif($_GET['service'] == 'group'){
            if($_GET['action'] == 'create'){
                if(2==2){ //@TODO : check that all fields are valid
                    $group = new stdclass();

                    $group->managedNetworks = array('TestCairn','Test');
                    $group->name = 'entreprises';
                    $group->internalName = $group->name;
                    $group->enabled = true;
                    $group->adminType = 'network';
                    $group->canRegisterNetworks = true;

                    createGroup($group);
                }
            }
            elseif($_GET['action'] == 'remove'){
                if(2==2){ //@TODO : check that all fields are valid
                    //search for the group
                    $groupNames = array('Test2');
                    removeGroups($groupNames);
                }
            }
            elseif($_GET['action'] == 'modify'){
                if(2==2){ //@TODO : check that all fields are valid
                    //search for the group
                    $query = new stdclass();
                    $name = 'Admins';
                    $id = groupID($name);

                    modifyGroup($id);
                }
            }

        }
    }
    //        elseif($_GET['service'] == 'currency'){
    //            if($_GET['action'] == 'create'){
    //                if(2 == 2){ //@TODO :check that all fields are valid
    //                    $currency = new stdclass();
    //                    $currency->precision = $_POST['precision'];
    //                    $currency->NAME = $_POST['name'];
    //                    $currency->symbol    = $_POST['symbol'];
    //                    //                $currency->transserviceNumberEnabled    = $_POST['transserviceNumberEnabled'];
    //
    //                    createCurrency($currency);
    //                }
    //                else{
    //                    throw new Exception('Can\'t create new currency : invalid parameters');
    //                }
    //            }
    //            elseif($_GET['action'] == 'remove'){
    //                if(2 == 2){ //@TODO: check the id
    //                    removeCurrency($_GET['id']);
    //                }
    //                else{
    //                    throw new Exception('Can\'t remove this currency : incorrect id given');
    //                }
    //            }
    //            elseif($_GET['action'] == 'list'){
    //                listCurrencies();
    //            }
    //        }
    else{ //default case
        listCurrencies();
    }    

} catch(Exception $e){                                                         
    echo 'Erreur :' .  $e->getMessage();                                          
    print_r($e->error);
}    
