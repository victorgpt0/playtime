<?php
class globals{
    public function setMsg($name,$value,$css){
        if(is_array($value)){
            $_SESSION[$name]=$value;
        }else{
            $_SESSION[$name]="<div class='".$css."'>".$value."</div>";
        }
    }
    public function getMsg($name){
        if(isset($_SESSION[$name])){
            $session=$_SESSION[$name];
            unset($_SESSION[$name]);
            return $session;
        }
    }
}