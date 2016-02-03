<?php
class AuthController 
{
    public function actionLogin(){ 
          
        if (isset($_POST['login'])&&isset($_POST['password'])){
            $user = Auth::checkUser($_POST['login'], $_POST['password']);
            
            if ($user){
                $code = Auth::generateCode(10);
                $hash = Auth::setHash($user->user_id, $code);
                Auth::setAuthCookie($user->user_id, $hash);
            }
        }
        header("Location: /learns/");
    }
    
    public function actionLogout(){     
        Auth::setAuthCookie('', '');
        header("Location: /learns/");
    }
    
}