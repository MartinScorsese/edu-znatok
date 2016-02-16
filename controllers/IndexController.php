<?php
class IndexController 
{
    public function actionShow(){ 
        
        $courses = Courses::findAllByColumn('parent_id', 0);
        $view = new View();
        $view->courses = $courses;
        
      //  $view->user_login = $user->user_login;
       // $view->user_group = $user->user_group;

        $view->display('header.php');
        $view->display('content.php');
        $view->display('footer.php');

    }
    
}