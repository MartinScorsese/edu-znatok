<?php
class CoursesController 
{
    public function actionShow(){ 
        
        $view = new View();

      //  $view->user_login = $user->user_login;
       // $view->user_group = $user->user_group;

        $view->display('header.php');
        $view->display('content.php');
        $view->display('footer.php');

    }
}