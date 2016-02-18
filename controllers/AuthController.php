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
            }else{
                $_SESSION['login_error'] = 'Ошибка авторизации';
            }
        }
        header("Location: " . BASE_PATH . 'auth/');
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
        
        $auth = Auth::checkAuth();
        
        if(!$auth){
           $view = new View();
           
           $view->display('header.php');
           $view->display('auth/register.php');
           $view->display('footer.php');
        }else{
            header("Location: " . BASE_PATH . 'users/');
        }
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
            $data_array = Auth::verifyData($data_array, 'reg');
            if (!$data_array){
                header('Location: ' . BASE_PATH . 'auth/register/');
            }
            $user = new Users();
            $user->email = $data_array['email'];
            $user->password = md5(md5($data_array['password']));
            $user->save();
            $user = Users::findOneByColumn('email', $data_array['email']);
            $user->setProfile();
        }else{
            header('Location: ' . BASE_PATH);
        }
        header('Location: ' . BASE_PATH . 'auth/');
    }
    
    /*
     * Восстановление пароля пользователя
     */
    public function actionRestore(){
        
    }
    
}
