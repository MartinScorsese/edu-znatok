<?php
class IndexController 
{
   public function actionShow(){ 
        
        $view = new View();

        $lessons = Lessons::findAll();
        $view->lessons = $lessons;

        $view->display('admin/header.php');
        $view->display('admin/lessons/list.php');
        $view->display('admin/footer.php');

    }
    
    public function actionTest(){
        $course = Courses::findOneByPK(11);
        $course->delete();
        var_dump($course);die;
    }
}