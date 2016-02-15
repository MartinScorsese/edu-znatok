<?php
class IndexController 
{
    public function actionShow(){ 
        
        $courses = Courses::getParentCourses();
        $view = new View();
        $view->courses = $courses;
        
      //  $view->user_login = $user->user_login;
       // $view->user_group = $user->user_group;

        $view->display('header.php');
        $view->display('content.php');
        $view->display('footer.php');

    }
    
    public function actionTest(){
        $course = new Courses;
        $course->name = 'Программирование для взрослых';
        $course->description = 'фулюганьё сплошное';
        $course->parent_id = '8';
        
        $course->insert();
        var_dump($course);die;
    }
}