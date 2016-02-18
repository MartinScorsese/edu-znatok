<?php
/** table: users
 * @property $id
 * @property $email
 * @property $password
 * @property $hash
 * @property $status
 * * table: users_profiles
 * @property $id
 * @property $name
 * @property $surname
 * @property $patronymic
 * @property $img
 * @property $birthday
 * @property $reg_date
 * @property $city
 * *table :usesr_sessions
 * @property $id
 * @property $code
 * @property $user_agent
 */
class Users extends AbstractModel {

    static protected $table = 'users';
    static protected $profile_table = 'users_profiles';
    
    public function getProfile() {
        
        $db = new DB();
        $sql = "SELECT * FROM " . self::$profile_table . " WHERE id=:id";
        $profile = $db->query($sql, [':id'=>$this->id]);
        
        foreach ($profile[0] as $key => $val){
            if ('id' == $key){
                continue;
            }
            $this->$key = $val;
        }

        $this->age = Helper::getAge($this->birthday);
    }
    
    public function setProfile() {
        
        $db = new DB();
        $sql = "INSERT INTO " . self::$profile_table . " (id, img) VALUES (:id, :img)";
        $db->execute($sql, ['id' => $this->id, 'img'=>'img/defaults/owl00' . rand(1, 6) . '.png']);
    }
    
    public function saveProfile() {
        $profile_fields = ['id', 'name', 'surname', 'patronymic', 'img', 'birthday', 'city'];
        $profile_sub = [];
        $cols = [];
        
        foreach ($profile_fields as $k){
            $profile_sub[':' . $k] = $this->$k;
            if ('id' == $k){
                continue;
            } 
            $cols[] = $k . '=:' . $k;
        }
        $sql = "UPDATE " . self::$profile_table . " "
                . "SET " . implode(', ', $cols) . " "
                . "WHERE id=:id";
        $db = new DB();
        $db->execute($sql, $profile_sub);
    }
}