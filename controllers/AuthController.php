<?php
/**
 * Класс отвечающий за авторизацию, регистрацию и восстановление пароля
 */
class AuthController 
{
    public function actionShow(){
        /*
         * Проверить авторизацию, если пользователь авторизован
         * отправить на страницу профиля, если не авторизован
         * показать форму авторизации
         */
        $auth = Auth::checkAuth();
        if(!$auth){
           $view = new View();
           
           $view->display('header.php');
           $view->display('auth/login.php');
           $view->display('footer.php');
        }else{
            header("Location: " . BASE_PATH . 'users/');
        }
    }
    /*
     * Авторизация пользователя
     */
    public function actionLogin(){
        
        if (isset($_POST['email'])&&isset($_POST['password'])){
            $user = Users::findOneByColumn('email', $_POST['email']);
            if ($user) {
                if (md5(md5($_POST['password'])) == $user->password){
                    $code = Helper::generateCode(10);
                    $hash = Helper::generateHash($code);
                    $user->hash = $hash;
                    Auth::setAuthSession($user->id, $hash);
                    Auth::setSessionData($user->id, $hash);
                    $user->save();
                    if ($_POST['remember']){
                        Auth::setAuthCookie($user->id, $hash);
                    }
                }
            }
        }
        header("Location: " . BASE_PATH);
    }
    
    /*
     * Выход пользователя
     */
    public function actionLogout(){     
        Auth::setAuthCookie('', '');
        session_destroy();
        header("Location: " . BASE_PATH);
    }
    
    /*
     * Регистрация пользователя
     */
    public function actionRegister(){
        
    }
    
    public function actionSave(){
        /*
         * Валидация данных
         */
        $data_array = $_POST;
        
        /*
         * Заполнение свойств пользователя
         */
        if(!empty($data_array)){
            $user = new Users();
            foreach ($data_array as $key => $value){
                $user->$key = $value;
            }
            $user->save();
        }else{
            header('Location: ' . BASE_PATH);
        }
        header('Location: ' . BASE_PATH);
    }
    
    /*
     * Восстановление пароля пользователя
     */
    public function actionRestore(){
        
    }
    
}
