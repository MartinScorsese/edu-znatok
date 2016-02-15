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
        $course = Courses::findOneByColumn('course_name', 'Программирование для детей');
        $course->course_name = 'Программирование для взрослых';
        $course->save();
        var_dump($course);die;
    }
}