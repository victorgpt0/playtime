<?php
header("Content-type: application/json");

$stkCallback=file_get_contents('php://input');
$logFile="Mpesastkresponse.json";
$log=fopen($logFile,"a");
fwrite($log,$stkCallback);
fclose($log);

$data=json_decode($stkCallback);
$MerchantRequestID=$data->Body->stkCallback->MerchantRequestID;
$CheckoutRequestID=$data->Body->stkCallback->CheckoutRequestID;
$ResultCode=$data->Body->stkCallback->ResultCode;
$ResultDesc=$data->Body->stkCallback->ResultDesc;
$Amount=$data->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$TransactionID=$data->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$UserPhoneNumber=$data->Body->stkCallback->CallbackMetadata->Item[4]->Value;

if($ResultCode===0){
    //insert to Db
}else{
    print_r($data);
}