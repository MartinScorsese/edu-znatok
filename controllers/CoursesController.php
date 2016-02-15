<?php
class CoursesController 
{
    public function actionShow(){ 
        
        $id = $_GET['id'];
        
        $courses = Courses::findAllByColumn('parent_id', $id);
        $view = new View();
        $view->courses = $courses;
      //  $view->user_login = $user->user_login;
       // $view->user_group = $user->user_group;
        $parent_course = Courses::findOneByPK($id);
        $view->page_title = $parent_course->name;
        
        $view->display('header.php');
        if(isset($id)){
            

            $view->display('courses/child-list.php');
        }else{
            $view->display('courses/list.php');
        }
        $view->display('footer.php');

    }
}