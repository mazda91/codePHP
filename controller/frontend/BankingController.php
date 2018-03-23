<?php
require("model/frontend/BankingManager.php");

function payment($from,$to,$amount,$count){
    $bankingManager = new BankingManager();
    $bankingManager->makeRecurringPayment($from,$to,$amount,$count);
}
