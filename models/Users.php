<?php
class Users extends AbstractModel {
    /* Списки для выбора заданных значений в полях "Образование" и "Семейный статус"
    *  Размешены в классе пользователя, чтобы не плодить сущности в рамках тестового
    *  задания;
    *  Так-же не разделены классы "Пользователь" и "Авторизация".
    */
     
    
    static protected $table = 'users';
    static protected $sessions_table = 'sessions';


    public $edu_type = ['form_education_high','form_education_incom_high','form_education_prof','form_education_base'];
    public $family_status = ['form_family_status_marryed' , 'form_family_status_free', 'form_family_status_search'];
    
    // Переменные соостветствующие полям в бд в таблице users
    public $user_id,
            $user_email,
            $user_password,
            $user_hash,
            $user_status,
            $user_name,
            $user_images,
            $user_patronymic,
            $user_surname,
            $user_birthday,
            $user_location,
            $user_family_status,
            $user_education,
            $user_experience,
            $user_phone,
            $user_skype,
            $user_additional;
    
    public function __construct($data = ''){
        
        $this->user_id = (isset($data['user_id'])) ? $data['user_id'] : "";
        $this->user_email = (isset($data['user_email'])) ? $data['user_email'] : "";
        $this->user_password = (isset($data['user_password'])) ? $data['user_password'] : "";
        $this->user_hash = (isset($data['user_hash'])) ? $data['user_hash'] : "";
        $this->user_status = (isset($data['user_status'])) ? $data['user_status'] : "";
        $this->user_name = (isset($data['user_name'])) ? $data['user_name'] : "";
        $this->user_images = (isset($data['user_images'])) ? $data['user_images'] : "";
        $this->user_patronymic = (isset($data['user_patronymic'])) ? $data['user_patronymic'] : "";
        $this->user_surname = (isset($data['user_surname'])) ? $data['user_surname'] : "";
        $this->user_birthday = (isset($data['user_birthday'])) ? $data['user_birthday'] : "";
        $this->user_location = (isset($data['user_location'])) ? $data['user_location'] : "";
        $this->user_family_status = (isset($data['user_family_status'])) ? $data['user_family_status'] : "";
        $this->user_education = (isset($data['user_education'])) ? $data['user_education'] : "";
        $this->user_experience = (isset($data['user_experience'])) ? $data['user_experience'] : "";
        $this->user_phone = (isset($data['user_phone'])) ? $data['user_phone'] : "";
        $this->user_skype = (isset($data['user_skype'])) ? $data['user_skype'] : "";
        $this->user_additional = (isset($data['user_additional'])) ? $data['user_additional'] : "";
    } 
    
    public function getUser($user_id = ''){
        /*
         * Если в функцию не передан id, значит получаем id
         * из текущей сессии и возвращаем пользователя
         */
        if(!$user_id){
            $user_id = $_SESSION['user_id'];
        }
        
        if(!empty($user_id)){
            $db = new DB;
            $query = "SELECT * FROM " . self::$user_table . " WHERE user_id=:user_id";
            $params = ['user_id'=> $user_id];
            $user = $db->query($query, $params);
        }

        return $user[0];
    }
    
    /*
     * Добавляем пользователя в базу данных
     */
    public function setUser(){
        
        $this->user_password = md5(md5($this->user_password));
        $this->user_status = '1';
        
        $db = new DB;
        
        $query = "INSERT INTO " . self::$user_table . " (user_email, "
                . "user_password, "
                . "user_status, "
                . "user_name, "
                . "user_images, "
                . "user_patronymic, "
                . "user_surname, "
                . "user_birthday, "
                . "user_location, "
                . "user_family_status, "
                . "user_education, "
                . "user_experience, "
                . "user_phone, "
                . "user_skype, "
                . "user_additional) VALUES("
                . ":user_email, "
                . ":user_password, "
                . ":user_status, "
                . ":user_name, "
                . ":user_images, "
                . ":user_patronymic, "
                . ":user_surname, "
                . ":user_birthday, "
                . ":user_location, "
                . ":user_family_status, "
                . ":user_education, "
                . ":user_experience, "
                . ":user_phone, "
                . ":user_skype, "
                . ":user_additional)";
        $params = ['user_email' => $this->user_email,
                    'user_password' => $this->user_password,
                    'user_status' => $this->user_status,
                    'user_name' => $this->user_name,
                    'user_images' => $this->user_images,
                    'user_patronymic' => $this->user_patronymic,
                    'user_surname' => $this->user_surname,
                    'user_birthday' => $this->user_birthday,
                    'user_location' => $this->user_location,
                    'user_family_status' => $this->user_family_status,
                    'user_education' => $this->user_education,
                    'user_experience' => $this->user_experience,
                    'user_phone' => $this->user_phone,
                    'user_skype' => $this->user_skype,
                    'user_additional' => $this->user_additional
                ];
        $this->user_id = $db->insert($query, $params);
    }
    
    /*
     * Проверяем соответсвие логина(email) и пароля
     * Метод возвращает пользователя или false
     */
    public function checkUser($email, $password){
        
        $db = new DB;
        $user = $db->query("SELECT * FROM " . self::$user_table . " WHERE user_email=:email", ['email'=>$email]);
        if ($user[0]->user_password == md5(md5($password))){
            return $user[0];
        }
        return false;       
    }
    
    /*
     * Метод проверяет авторизован ли пользователь
     * возвращает true или false
     */
    public function checkAuth(){
        
        if (isset($_SESSION['user_id']) and isset($_SESSION['user_hash'])) {
            /*
             * Если нужно запретить пользователю авторизваться сразу на нескольких
             * устройствах - нужно добавить сравнение кода агента либо сравнение хэшей
             */
            return true;
        }else {
            //~ проверяем наличие кук
            if (isset($_COOKIE['user_id']) and isset($_COOKIE['user_hash'])) {
                //~ если есть куки, сверяем hash в куках,с хэшем у пользователя
                $user_id = $_COOKIE['user_id'];
                $user_hash = $_COOKIE['user_hash'];
                $db = new DB;
                $user = $db->query("SELECT user_hash FROM " . self::$user_table . " WHERE user_id=':user_id'", ['user_id' => $user_id]);
                if ($user_hash == $user[0]->user_hash) {
                    /*
                     * Если есть запись в таблице сессий и код сессии
                     * совпадает с хэшем пользователя и код user_agent 
                     * соответствует текущему - открываем сессии и обновляем куки.
                    */
                   $session = $db->query("SELECT * FROM " . self::$sessions_table . " WHERE session_user_id=':user_id'", ['user_id' => $user_id]);

                   if ($session && $session[0]->session_code == $user_hash){    
                       if ($_SERVER['HTTP_USER_AGENT'] == $sessin[0]->session_user_agent){
                            Users::setAuthSession($user_id, $user_hash);
                            Users::setAuthCookie($user_id, $user_hash);
                        }else {
                            return false;
                        }   
                   }else {
                       return false;
                   }
                }else {
                    return false;
                }    
            }else {
                return false;
            }
        }
        return false;
    }
    
    public function setAuthCookie($id, $hash){
        setcookie("id", $id, time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30);
    }
    
    public function setAuthSession($id, $hash){
        $_SESSION['user_id'] = $id;
        $_SESSION['user_hash'] = $hash;    
    }
    /*
     * Метод добавляет и обновляет данные в таблице сессий
     */
    public function setSessionData($user_id, $hash){
        $db = new DB();
        $session = $db->query("SELECT * FROM " . self::$sessions_table . " WHERE session_user_id=:user_id", ['user_id'=>$user_id]);
        if(!$session) {
            $query = "INSERT INTO " . self::$sessions_table . " (session_user_id, "
                    . "session_user_agent, "
                    . "session_code) VALUES("
                    . ":user_id, "
                    . ":user_agent, "
                    . ":hash)";
        }else{
            $query = "UPDATE " . self::$sessions_table . " SET session_code=:hash, session_user_agent=:user_agent WHERE session_user_id=:user_id";    
        }
        $params = ['user_id' => $user_id,
                   'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                   'hash' => $hash
                   ];
        $db->query($query, $params);
    }
    /*
     * Метод генерирующий хэш.
     */
    public function setHash($id, $code){
        $hash = md5($code);
        $db = new DB;
        $query = "UPDATE " . self::$user_table . " SET user_hash=:hash WHERE user_id=:user_id";
        $params = ['hash' => $hash, 'user_id'=>$id];
        $db->query($query, $params);
        
        return $hash;
    }
    
    public function generateCode($length=6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
                $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
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