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
 * @property $photo
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
    }
    
    public function setProfile() {
        
    }
    
    /*
     * Метод проверки входных данных
     * Функция принимает массив данных и необязательный параметр
     * type - для проверки источника запроса и выбора алгоритма.
     * reg - все данные формы регистрации, после срабатывания события submit
     * form_validate - ajax запрос при вводе e-mail в форме регистрации
     */
    public function verifyData($data, $type = 'form_validate'){
        if ('form_validate' == $type){
            if (isset($data['user_email'])){
                $db = new DB;
                $user_id = $db->query("SELECT user_id FROM users WHERE user_email=:user_email", ['user_email' => $data['user_email']]);

                if($user_id){
                    return $data = [
                                'status' => 'error',
                                'msg' => 'errors_email_double',
                                ];
                }else{
                    return $data = [
                                'status' => 'success',
                                'msg' => '',
                                ];
                }       
            }
        }else if ('reg' == $type){
            /*
             * Проверка обязательных входных данных из формы регистрации
             * 
             */
            $errors = 0;
            
            if (!preg_match('/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i', $data['user_email'])){
                $_SESSION['email_error'] = 'errors_email_incorrect';
                $errors++;
            }
            if ($data['user_password'] !== $data['check_password']){
                $_SESSION['pass_error'] = 'errors_password_check';
                $errors++;
            }
            if (empty($data['user_password']) || empty($data['check_password'])){
                $_SESSION['pass_empty_error'] = 'errors_password_empty';
                $errors++;
            }
            if (!preg_match('/(^[А-Яа-яёЁa-zA-z]+$)/i', $data['user_name'])){
                $_SESSION['name_error'] = 'errors_input_name';
                $errors++;
            }
            
            if (!preg_match('/(^[А-Яа-яёЁa-zA-z]+$)/i', $data['user_patronymic']) && !empty($data['user_patronymic'])){
                $_SESSION['patronymic_error'] = 'errors_input_patronymic';
                $errors++;
            }
            if (!preg_match('/(^[А-Яа-яёЁa-zA-z]+$)/i', $data['user_surname']) && !empty($data['user_surname'])){
                $_SESSION['surname_error'] = 'errors_input_surname';
                $errors++;
            }
                
            
            if ($errors != '0'){
                return false;
            }
            
            if (!empty($_FILES)){
                $data['user_images'] = Files::upload($_FILES, 'users');
            }
            
            return $data;
            
        }
        
    }
    
}