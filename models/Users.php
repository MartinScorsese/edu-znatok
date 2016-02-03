<?php
class Users extends AbstractModel {
    public $date;
    
    public function getDate(){
        
       // $db = new DB;
       // $query = "SELECT user_birthday FROM death_timer WHERE user_id='1'";
       // $date = $db->query($query);
        
		$date[0] = time();
        return $date[0]->user_birthday;       
    }
    
} 