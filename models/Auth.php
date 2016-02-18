<?php
class Auth extends AbstractModel {

    static protected $table = 'users_sessions';
    static protected $users_table = 'users';
    
    /*
     * Метод проверяет авторизован ли пользователь
     * возвращает id пользователя или false
     */
    public function checkAuth(){
        
        if (isset($_SESSION['id']) and isset($_SESSION['hash'])) {
            /*
             * Если нужно запретить пользователю авторизваться сразу на нескольких
             * устройствах - нужно добавить сравнение кода агента либо сравнение хэшей
             */
            return $_SESSION['id'];
        }else {
            //~ проверяем наличие кук
            if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
                //~ если есть куки, сверяем hash в куках,с хэшем у пользователя
                $id = $_COOKIE['id'];
                $hash = $_COOKIE['hash'];
                $db = new DB;
                $user = $db->query("SELECT hash FROM " . self::$users_table . " WHERE id=':id'", ['id' => $id]);
                if ($hash == $user[0]->hash) {
                    /*
                     * Если есть запись в таблице сессий и код сессии
                     * совпадает с хэшем пользователя и код user_agent 
                     * соответствует текущему - открываем сессии и обновляем куки.
                    */
                   $session = $db->query("SELECT * FROM " . self::$table . " WHERE id=':id'", ['id' => $id]);

                   if ($session && $session[0]->code == $hash){    
                       if ($_SERVER['HTTP_USER_AGENT'] == $sessin[0]->user_agent){
                            self::setAuthSession($id, $hash);
                            self::setAuthCookie($id, $hash);
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
        $_SESSION['id'] = $id;
        $_SESSION['hash'] = $hash;    
    }
    /*
     * Метод добавляет и обновляет данные в таблице сессий
     */
    public function setSessionData($id, $hash){
        $db = new DB();
        $session = $db->query("SELECT * FROM " . self::$table . " WHERE id=:id", ['id'=>$id]);
        if(!$session) {
            $query = "INSERT INTO " . self::$table . " (id, "
                    . "user_agent, "
                    . "code) VALUES("
                    . ":id, "
                    . ":user_agent, "
                    . ":hash)";
        }else{
            $query = "UPDATE " . self::$table . " SET code=:hash, user_agent=:user_agent WHERE id=:id";    
        }
        $params = ['id' => $id,
                   'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                   'hash' => $hash
                   ];
        $db->query($query, $params);
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
                $user_id = $db->query("SELECT id FROM " . self::$users_table . " WHERE email=:email", ['email' => $data['email']]);

                if($user_id){
                    return $data = [
                                'status' => 'error',
                                'msg' => 'Такой e-mail уже зарегистрирован',
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
            
            $db = new DB;
            $user_id = $db->query("SELECT id FROM " . self::$users_table . " WHERE email=:email", ['email' => $data['email']]);
            if ($user_id) {
                $_SESSION['email_error'] = 'E-mail: <b>' . $data['email'] . '</b> уже зарегистрирован';
                $errors++;
            }
            
            if (!preg_match('/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i', $data['email'])){
                $_SESSION['email_error'] = 'E-mail введен не корректно. Пример: info@ik-edu.ru';
                $errors++;
            }
            if ($data['password'] !== $data['check_password']){
                $_SESSION['pass_error'] = 'Введенные пароли не совпадают';
                $errors++;
            }
            if (empty($data['password']) || empty($data['check_password'])){
                $_SESSION['pass_empty_error'] = 'Поле "Пароль" не может быть пустым';
                $errors++;
            }   
            
            if ($errors != '0'){
                return false;
            }
            
            return $data;
            
        }
        
    }
    
}