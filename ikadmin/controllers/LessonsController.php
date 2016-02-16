<?php
class LessonsController 
{
    public function actionShow(){ 
        
        $view = new View();

        $lessons = Lessons::findAll();
        $view->lessons = $lessons;

        $view->display('admin/header.php');
        $view->display('admin/lessons/list.php');
        $view->display('admin/footer.php');

    }
    
    public function actionLesson(){ 
        
        $lesson_id = $_GET['lesson_id'];
        $view = new View();

      //  $view->user_login = $user->user_login;
       // $view->user_group = $user->user_group;
        
        if(isset($lesson_id)){
            $view->display('header.php');
            $view->display('lessons/lesson.php');
            $view->display('footer.php');
        }else{
            header("HTTP/1.1 404 Not Found");
            $view->display('errors/404.php');
        }

    }
    
}