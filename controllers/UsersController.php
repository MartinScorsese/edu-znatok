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
     * Сохранение пользователя
     */
    public function actionSave(){
        $data_array = $_POST;
        if(!empty($data_array)){
            $course = new Courses();
            foreach ($data_array as $key => $value){
                $course->$key = $value;
            }
            if (!empty($_FILES)){
                $course->img = Files::upload($_FILES, 'courses');
            }
            $course->save();
        }else{
            header('Location: ' . ADMIN_PATH);
        }
        header('Location: ' . ADMIN_PATH . '?ctrl=courses&act=edit&id=' . $course->id);
    }
}