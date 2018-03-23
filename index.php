<? 
require_once("load.php");
//require("controller/backend/CurrencyController.php");                               
require("controller/backend/NetworkController.php");
require("controller/backend/UserController.php");
require("controller/backend/GroupController.php");
require("controller/backend/AccountController.php");
require("controller/backend/ProductController.php");

require("controller/frontend/BankingController.php");

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
            elseif($_GET['action'] == 'get'){
                getNetwork('TestCairn3');
            } 
            elseif($_GET['action'] == 'switch'){
                switchNetwork('TestCairn3');
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
                    $user->passwords = $password;
                    //                      $user->loginPassword ="pain";
                    //$user->assign = true;
                    if($_GET['status'] == 'admin'){//by default, the group is 'Global administrators'
                        createAdmin($user);
                    }
                    else{//if not admin then user
                        switchNetwork('TestCairn3');
                        $groupName = 'group1';
                        createMember($user,$groupName);
                    }
                }
                else{//some invalid fields
                    throw new Exception("Error : invalid fields given");
                } 
            }
            elseif($_GET['action'] == 'get'){
                if(2==2){ //@TODO : check that all fields are valid
                    switchNetwork('TestCairn3');
                    $name = 'Santo3'; 
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
                    createAccount($product,$ownerName); 
                }
            }
        }
        elseif($_GET['service'] == 'product'){
            if($_GET['action'] == 'assign'){
                if(2==2){ //@TODO : check that all fields are valid
                    switchNetwork('TestCairn3');
                    $product = new stdclass();

                    $product->name = 'stup';
                    //                    $product->nature = new stdclass();
                    $product->nature = 'MEMBER';

                    $groupName = 'group1';
                    createProduct($product,$groupName); 
                }
            }
            elseif($_GET['action'] == 'get'){
                if(2==2){ //@TODO : check that all fields are valid
                    switchNetwork('TestCairn3');

                    $productName = 'Members';
                    $ownerName = NULL;//'Users';
                    $product = productData($productName,$ownerName); 
                    print_r($product);
                }
            }
        }
        elseif($_GET['service'] == 'banking'){
            if($_GET['action'] == 'payment'){
                if(2==2){//@TODO: check that all fields are valid
                    switchNetwork('TestCairn3');
                    $from = 'SYSTEM';
                    $to = 'Santo3';
                    $amount = 1;
                    $count = 4; 

                    if($_GET['type'] == 'unique'){
                        $count = 1;
                    }
                    else{
                        $count = 4;
                    }
                    payment($from,$to,$amount,$_GET['type'],$count);
                }
            }
            elseif($_GET['action'] == 'fee'){
                if(2==2){//@TODO: check that all fields are valid
                    if($_GET['type'] == 'account'){

                    }
                    elseif($_GET['type'] == 'transfer'){

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
