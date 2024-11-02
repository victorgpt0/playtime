<?php
require_once 'vendor/autoload.php';



class google{
    private $client;
    private $redirect_uri='http://localhost:3000/src/plugins/login.php';
    private $config;
    
    public function __construct(){
        $this->config =json_decode(file_get_contents(__DIR__.'/api/oauth.json'),true);
        $this->client= new Google_Client();
        $this->client->setClientId($this->config['web']['client_id']);
        $this->client->setClientSecret($this->config['web']['client_secret']);
        $this->client->setRedirectUri($this->redirect_uri);
        $this->client->addScope('https://www.googleapis.com/auth/userinfo.profile');
        $this->client->addScope('email');
        $this->client->addScope('https://www.googleapis.com/auth/calendar');
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
        if($this->hasStoredTokens()){
            $this->client->setAccessToken($_SESSION['google_tokens']);

            if($this->client->isAccessTokenExpired()){
                $this->refreshToken();
            }
        }
    }

    public function hasStoredTokens(){
        return isset($_SESSION['google_tokens']);
    }

    public function createAuthUrl(){
        return $this->client->createAuthUrl();
    }

    public function handleCallback($authcode){
        try{
             $token=$this->client->fetchAccessTokenWithAuthCode($authcode);
             if(!isset($token['error'])){
                $_SESSION['google_tokens']=$token;
                return true;

             }
             return false;
        } catch(Exception $e){
            error_log('Error during oauth callback '.$e->getMessage());
            return false;
        }
    }

    private function refreshToken(){
        try{
            if($this->client->getRefreshToken()){
                $this->client->fetchAccessTokenWithRefreshToken();
                $_SESSION['google_tokens']=$this->client->getAccessToken();
            }
        } catch(Exception $e){
            error_log('Error refreshing token '. $e->getMessage());
            unset($_SESSION['google_tokens']);
        }
    }

    public function getClient(){
        return $this->client;
    }

}