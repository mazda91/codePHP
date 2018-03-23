<?php

require_once("load.php");                                                      
require_once("model/Manager.php");

class BankingManager extends Manager{

    public final function makeUniquePayment($from,$to,$amount)
    {
        $transactionService = new Cyclos\TransactionService();
        $paymentService = new Cyclos\PaymentService();

        //            $transferTypeService = new Cyclos\TransferTypeService();
        //            $query = new stdclass();
        //            $query->currency = 'cairn';
        //            $res = $transferTypeService->search($query);
        //            print_r($res);

        //            $data2 = $transferTypeService->getData($res->pageItems[1]->id);
        //            print_r($data2);
        //récuperer data pour une transaction
        //            $transac = new stdclass();
        //            $transac->id = $res->pageItems[1]->id;

        //            $res2 = $transactionService->getData($transac);
        //            print_r($res2); 
        //
        $transferType = new stdclass(); //TransferTypeWithCurrencyVO
        //            $transferType->name = 'toUser';
        $transferType->currency = 'cairn';
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
        $parameters = new stdclass();
        $parameters->from = $data->from;
        $parameters->to = $data->to;
        $parameters->type =$data->paymentTypes[0]; 
        $parameters->amount = $amount;
        $parameters->description = "Test from system to user";

        $paymentResult = $paymentService->perform($parameters);

    }

    public final function makeRecurringPayment($from,$to,$amount,$count){
        $paymentService = new Cyclos\RecurringPaymentService();
        $transactionService = new Cyclos\TransactionService();

        $transferType = new stdclass(); //TransferTypeWithCurrencyVO
        //            $transferType->name = 'toUser';
        $transferType->currency = 'cairn';

        $data = $transactionService->getPaymentData($from, array('username' => $to),$transferType);
        $params = new stdclass();
        $params->from = $data->from;
        $params->to = $data->to;
        $params->type =$data->paymentTypes[0]; 
        $params->amount = $amount;
        $params->description = "Test from system to user";

        $params->firstOccurrenceIsNow = true;
        $params->occurrenceInterval = new stdclass();
        $params->occurrenceInterval->field = 'SECONDS';
        $params->occurrenceInterval->amount = 15;
        $params->occurencesCount = $count;
        $params->untilCanceled = true;
        $paymentResult = $paymentService->perform($params);
    }

    public final function makeScheduledPayment($from,$to,$amount,$count){
        $paymentService = new Cyclos\ScheduledPaymentService();
        $transactionService = new Cyclos\TransactionService();

        $transferType = new stdclass(); //TransferTypeWithCurrencyVO
        //            $transferType->name = 'toUser';
        $transferType->currency = 'cairn';

        $data = $transactionService->getPaymentData($from, array('username' => $to),$transferType);
        $params = new stdclass();
        $params->from = $data->from;
        $params->to = $data->to;
        $params->type =$data->paymentTypes[0]; 
        $params->amount = $amount;
        $params->description = "Test from system to user";

        $params->firstInstallmentIsNow = true;
        $params->installmentInterval = new stdclass();

        $installments = array();

        for($index = 1; $index <= $count ; $index++){
            $installment = new stdclass();
            $installment->amount = 2;
            $installment->dueDate = new stdclass();
            $installment->dueDate->maxYear = 2018;
            $installment->dueDate->maxMonth = 2;
            $installment->dueDate->maxDay = 23;
            $installment->dueDate->maxHour = 11;
            $installment->dueDate->maxMinute = 2 + $index;

            array_push($installments,$installment);
        }
        $params->installmentsCount = $count;
        $paymentResult = $paymentService->perform($params);

    }

}
