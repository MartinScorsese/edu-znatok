<?php
class LessonsController 
{
    public function actionShow(){ 
        
        $course_id = $_GET['course_id'];
        $view = new View();
        
      //  $view->user_login = $user->user_login;
       // $view->user_group = $user->user_group;
        
        if(isset($course_id)){
            
            $lessons = Lessons::findAllByColumn('parent_id', $course_id);
            $course = Courses::findOneByPK($course_id);
            
            $view->lessons = $lessons;
            $view->page_title = $course->name;
            
            $view->display('header.php');
            $view->display('lessons/list.php');
            $view->display('footer.php');
        }else{
            throw new ControllerException('Невозможно отобразить список уроков для данного курса', '404');
        }

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