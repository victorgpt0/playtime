<?php 
class user{
    private $u_id;
    private $username;
    private $email;
    private $role;

    public function __construct($u_id,$username,$email,$role){
        $this->u_id=$u_id;
        $this->username=$username;
        $this->email=$email;
        $this->role=$role;
    }
    public function setUser(){
        if(session_status()==PHP_SESSION_NONE){
            session_start();
        }     
        $_SESSION['user']=[
            'u_id'=>$this->u_id,
            'username'=>$this->username,
            'email'=>$this->email,
            'role'=>$this->role
        ];
    }

    public static function getUser(){
        if(session_status()==PHP_SESSION_NONE){
            session_start();
        } 
        return  isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }

    public static function clearUser(){
        if(session_status()==PHP_SESSION_NONE){
            session_start();
        } 
        unset($_SESSION['user']);
    }


}