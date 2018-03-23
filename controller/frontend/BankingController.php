<?php
require("model/frontend/BankingManager.php");

function payment($from,$to,$amount,$frequencyType,$count){
    $bankingManager = new BankingManager();
    if($frequencyType == 'unique'){
        $bankingManager->makeUniquePayment($from,$to,$amount);
    }
    elseif($frequencyType == 'scheduled'){
        $bankingManager->makeScheduledPayment($from,$to,$amount,$count);
    }
    elseif($frequencyType == 'recurring'){
        $bankingManager->makeRecurringPayment($from,$to,$amount,$count);
    }

}

function fee(){
    ;
}
