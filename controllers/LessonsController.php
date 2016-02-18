<?php
class LessonsController 
{
    public function actionShow(){ 
        
        $auth = Auth::checkAuth();
        if ($auth){
            $user = Users::findOneByPK($auth);
            $user->getProfile();
        }
        
        $course_id = $_GET['course_id'];
        $view = new View();
        
      //  $view->user_login = $user->user_login;
       // $view->user_group = $user->user_group;
        
        if(isset($course_id)){
            
            $lessons = Lessons::findAllByColumn('parent_id', $course_id);
            $course = Courses::findOneByPK($course_id);
            
            $view->user = $user;
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
        
        $auth = Auth::checkAuth();
        if ($auth){
            $user = Users::findOneByPK($auth);
            $user->getProfile();
        }
        
        $lesson_id = $_GET['lesson_id'];
        $view = new View();
        
      //  $view->user_login = $user->user_login;
       // $view->user_group = $user->user_group;
        
        if(isset($lesson_id)){
            $view->user = $user;
            $view->display('header.php');
            $view->display('lessons/lesson.php');
            $view->display('footer.php');
        }else{
            throw new ControllerException('Сожалеем, такого урока не существует', '404');
        }

    }
    
}