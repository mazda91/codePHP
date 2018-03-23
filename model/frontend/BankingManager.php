<?php

require_once("load.php");                                                      
require_once("model/Manager.php");

class BankingManager extends Manager{

    public final function makeRecurringPayment($from,$to,$amount,$count)
    {
        $transactionService = new Cyclos\TransactionService();
        $paymentService = new Cyclos\PaymentService();

            //récuperer le transfertType : peut-on y accéder ?
            $transferTypeService = new Cyclos\TransferTypeService();
            $query = new stdclass();
            $query->currency = 'cairn';
            $res = $transferTypeService->search($query);
//            print_r($res);

//            $data2 = $transferTypeService->getData($res->pageItems[1]->id);
//            print_r($data2);
            //récuperer data pour une transaction
            $transac = new stdclass();
            $transac->id = $res->pageItems[1]->id;
            
//            $res2 = $transactionService->getData($transac);
//            print_r($res2); 
            //
            $transferType = new stdclass();
            $transferType->name = 'toUser';
//            $transferType->id = $res->pageItems[1]->id;
//            $transferType->enabled = true;
//            $transferType->nature = 'PAYMENT';
//            $transferType->to = new stdclass();
//            $transferType->to->nature = 'USER';
//            $transferType->to->name = 'userAccount';
//            
//            $transferType->from = new stdclass();
//            $transferType->from->nature = 'SYSTEM';
//            $transferType->from->name = 'systemAccount';

//            $transferType->to->id
            $data = $transactionService->getPaymentData($from, array('username' => $to),$transferType);
//            print_r($data);
            $parameters = new stdclass();
            $parameters->from = $data->from;
            $parameters->to = $data->to;
            $parameters->type =$data->paymentTypes[0]; 
                $parameters->amount = $amount;
            $parameters->description = "Test from system to user";

            $paymentResult = $paymentService->perform($parameters);

    }
}
