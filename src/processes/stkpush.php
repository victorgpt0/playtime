<?php
class stkpush
{
    public function stkPush($phoneNum)
    {
        //GET ACCESS TOKEN
        $consumerKey = "";
        $consumerSecret = "";
        $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $headers = ['Content-Type:application/json; charset=utf-8'];
        $curl = curl_init($access_token_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);
        print_r($result);
        $access_token = $result->access_token;
        curl_close($curl);

        //STKPUSH

        date_default_timezone_set('Africa/Nairobi');
        $processrequestUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $callbackurl = 'https://playtime.infy.uk/callback.php';
        $passkey = "";
        $BusinessShortCode = '174379';
        $Timestamp = date('YmdHis');
        // ENCRIPT  DATA TO GET PASSWORD
        $Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
        $phone =$phoneNum; //phone number to receive the stk push
        $money = '1';
        $PartyA = $phone;
        $PartyB = '254708374149';
        $AccountReference = 'PLAYTIME';
        $TransactionDesc = 'stkpush test';
        $Amount = $money;
        $stkpushheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];
        //INITIATE CURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader); //setting custom header
        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $Password,
            'Timestamp' => $Timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $BusinessShortCode,
            'PhoneNumber' => $PartyA,
            'CallBackURL' => $callbackurl,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc
        );

        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        echo $curl_response = curl_exec($curl);
        //ECHO  RESPONSE
        $data = json_decode($curl_response);
        print_r($data);
        $CheckoutRequestID = $data->CheckoutRequestID;
        $ResponseCode = $data->ResponseCode;
        if ($ResponseCode == "0") {
            echo "The CheckoutRequestID for this transaction is : " . $CheckoutRequestID;
        }
    }

    public function query(){
        
    }
}
