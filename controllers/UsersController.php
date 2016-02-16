<?php
class UsersController 
{
    /*
     * Вывод профиля пользователя
     */
    public function actionShow(){     
       
        $auth = Users::checkAuth();
        
        if (!$auth){
            header("Location: " . BASE_PATH);
        }
        
        $user = Users::getUser();
        
        $view = new View();
        $view->user = $user;
        
        $view->display('header.php');
        $view->display('users/profile.php');
        $view->display('footer.php');
        
    }
        
    /*
     * Авторизация пользователя
     */
    public function actionAuth(){
        
        if (isset($_POST['user_email'])&&isset($_POST['user_password'])){
            $user = Users::checkUser($_POST['user_email'], $_POST['user_password']);
            if ($user){
                $code = Users::generateCode(10);
                $hash = Users::setHash($user->user_id, $code);
                Users::setAuthSession($user->user_id, $hash);
                Users::setSessionData($user->user_id, $hash);
                if ($_POST['remember']){
                    Users::setAuthCookie($user->user_id, $hash);
                }
            }
        }
        header("Location: " . BASE_PATH);
    }
    /*
     * Выход пользователя
     */
    public function actionLogout(){     
        Users::setAuthCookie('', '');
        session_destroy();
        header("Location: " . BASE_PATH);
    }
    
    /*
     * Регистрация пользователя
     */
    public function actionRegister(){ 
        
        $view = new View();
        $lang = Index::getLangArr();
        $user = new Users();

        $view->user = $user;
        $view->lang = $lang;
        
        $view->display('header.php');
        $view->display('users/register.php');
        $view->display('footer.php');
        
    }
    
    public function actionReg(){
        $data = Users::verifyData($_POST, 'reg');
        if (!$data){
            header("Location: " . BASE_PATH . "?ctrl=users&act=register");
        }else{
            $user = new Users($data);
            $user->setUser();
            header("Location: " . BASE_PATH);
        }
    }
    
    public function actionVerify(){
        $data = Users::verifyData($_POST);
        $lang = Index::getLangArr();
        
        $view = new View();
        $view->lang = $lang;
        $view->data_array = $data;
        
        $view->display('users/messages.php');
    }
}