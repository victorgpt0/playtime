<?php
require_once 'vendor/autoload.php';

$config = json_decode(file_get_contents('api/oauth.json'),true);
//var_dump($config);

$clientID=$config['web']['client_id'];
$clientSecret=$config['web']['client_secret'];
$redirect_uri='http://localhost:3000/src/plugins/login.php';

//create client request to google

$client= new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirect_uri);
$client->addScope('profile');
$client->addScope('email');


if(isset($_GET['code'])){
    $token=$client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);
    
    //get user profile
    $goauth=new Google_Service_Oauth2($client);
    $google_info=$goauth->userinfo->get();
    echo '<pre>';
    print_r($google_info);

}else{
    die('Go back to login page <a href="'.$client->createAuthUrl().'">Login</a>');
}