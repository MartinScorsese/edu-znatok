<?php
class Users extends AbstractModel {
    
    public $date;
    
    public function getUsers(){
        
        $db = new DB;
        $query = "SELECT user_login, user_id, user_group FROM users";
        $date = $db->query($query);
        
        return $date;
    }    
}