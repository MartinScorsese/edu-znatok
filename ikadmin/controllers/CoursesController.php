<?php
class CoursesController 
{
    public function actionShow(){ 
        
        $courses = Courses::findAll();
        
        $view = new View();
        $view->courses = $courses;
            
        $view->display('admin/header.php');
        $view->display('admin/courses/list.php');
        $view->display('admin/footer.php');
    }
    
    public function actionEdit(){
        
        $id = $_GET['id'];
        if(!empty($id)){
            $course = Courses::findOneByPK($id);
            $courses = Courses::findAll();
            if($course){
                $view = new View();
                $view->course = $course;
                $view->courses = $courses;
                
                $view->display('admin/header.php');
                $view->display('admin/courses/edit.php');
                $view->display('admin/footer.php');
            }else{
                header('Location: ' . ADMIN_PATH);
            }
        }else{
            header('Location: ' . ADMIN_PATH);
        }    
    }
    
    public function actionAdd(){
        
        $courses = Courses::findAll();    
        $view = new View();
        $view->courses = $courses;        
        $view->display('admin/header.php');
        $view->display('admin/courses/add.php');
        $view->display('admin/footer.php');  
    }
    
    public function actionDel(){
        
        $id = $_GET['id'];
        
        if(!empty($id)){
            $course = Courses::findOneByPK($id);
            if($course){
                $course->delete();
            }else{
                header('Location: ' . ADMIN_PATH);
            }
        }else{
            header('Location: ' . ADMIN_PATH);
        } 
        header('Location: ' . ADMIN_PATH . '?ctrl=courses');
    }
    
    public function actionSave(){
        $data_array = $_POST;
        if(!empty($data_array)){
            if(!empty($data_array['id'])){
                $course = Courses::findOneByPK($data_array['id']);
                foreach ($data_array as $key => $value){
                    $course->$key = $value;
                }
                if (!empty($_FILES)){
                    $course->img = Files::upload($_FILES, 'courses');
                }
                $course->update();
            }else{
                $course = new Courses();
                foreach ($data_array as $key => $value){
                    $course->$key = $value;
                }
                if (!empty($_FILES)){
                    $course->img = Files::upload($_FILES, 'courses');
                }
                $course->insert();    
            }    
        }else{
            header('Location: ' . ADMIN_PATH);
        }
        header('Location: ' . ADMIN_PATH . '?ctrl=courses&act=edit&id=' . $course->id);
    }
}