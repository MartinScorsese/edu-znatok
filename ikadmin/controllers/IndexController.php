<?php
class IndexController 
{
   public function actionShow(){ 
        
        $view = new View();

      //  $view->user_login = $user->user_login;
       // $view->user_group = $user->user_group;

        $view->display('admin/header.php');
        $view->display('admin/content.php');
        $view->display('admin/footer.php');

    }
    
    public function actionTest(){
        $course = Courses::findOneByPK(11);
        $course->delete();
        var_dump($course);die;
    }
}