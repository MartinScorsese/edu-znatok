<?php
class UsersController 
{
    /*
     * Вывод профиля пользователя
     */
    public function actionShow(){     
       
        $auth = Auth::checkAuth();
        
        if (!$auth){
            header("Location: " . BASE_PATH . 'auth/');
        }
        
        $user = Users::findOneByPK($auth);
        $user->getProfile();
        
        $view = new View();
        $view->user = $user;
        
        $view->display('header.php');
        $view->display('users/profile.php');
        $view->display('footer.php');
        
    }
    
    /*
     * Редактирование профиля
     */
    
    public function actionEdit(){
        $auth = Auth::checkAuth();
        if (!$auth){
            header("Location: " . BASE_PATH . 'auth/');
        }
        $user = Users::findOneByPK($auth);
        $user->getProfile();
        
        $view = new View();
        $view->user = $user;
        
        $view->display('header.php');
        $view->display('users/edit_profile.php');
        $view->display('footer.php');
    }
        
    /*
     * Сохранение пользователя
     */
    public function actionSave(){
        $data_array = $_POST;
        if(!empty($data_array)){
            $user = Users::findOneByPK(Auth::checkAuth());
            $user->getProfile();
            
            foreach ($data_array as $key => $value){
                $user->$key = $value;
            }
            if (!empty($_FILES['img']['name'])){
                $user->img = Files::upload($_FILES, 'users');
            }else{
                $user->img = 'img/defaults/owl00' . rand(1, 6) . '.png';
            }
            $user->saveProfile();
        }else{
            header('Location: ' . BASE_PATH . 'auth/');
        }
        header('Location: ' . BASE_PATH . 'users/');
    }
}