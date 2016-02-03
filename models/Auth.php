<?php
class Auth extends AbstractModel {
    
    public $date;
    
    public function generateCode($length=6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
                $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }
    
    public function checkUser($login, $password){
        
        $db = new DB;
        $query = "SELECT user_id, user_password FROM users WHERE user_login='" . $login . "'";
        $user = $db->query($query);
        
        if ($user[0]->user_password == md5(md5($password))){
            return $user[0];
        }
        return false;       
    }
    
    public function setHash($id, $code){
        $hash = md5($code);
        $db = new DB;
        $query = "UPDATE users SET user_hash='".$hash."' WHERE user_id='" . $id . "'";
        $db->query($query);
        
        return $hash;
    }
    
    public function checkAuth(){
        
        if(isset($_COOKIE['id'])&&isset($_COOKIE['hash'])){
            $db = new DB;
            $query = "SELECT user_hash FROM users WHERE user_id='" . $_COOKIE['id'] . "'";
            $user = $db->query($query);
            
            if ($_COOKIE['hash'] == $user[0]->user_hash){
                return true;
            }
        }
        return false;
    }
      
    public function setAuthCookie($id, $hash){
        setcookie("id", $id, time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30);
    }
    
    public function getUser(){
        //Исходим из того, что есть кука
        $db = new DB;
        $query = "SELECT user_login, user_group FROM users WHERE user_id='" . $_COOKIE['id'] . "'";
        $user = $db->query($query);
        
        return $user[0];
    }
    
    
    
} 