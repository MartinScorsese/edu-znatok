<?php
class AdminController 
{

    
    public function actionCourses() {
        
        $tasks = [
            'Добавить'=>'add',
            'Изменить'=>'edit',
            'Удалить'=>'del'
        ];
        
        $task = $_GET['task'];
        $id = $_GET['id'];
        
        $view = new View();
        $view->tasks = $tasks;
        
        if (!isset($task)){
            
            
            
        }elseif ('add' == $task) {
            if(!empty($_POST)){
                $id = Courses::addCourses($_POST);
                header('Location: /?ctrl=Admin&act=Courses&task=edit&id=' . $id);
            }
            
            $courses = Courses::getCourses();
            
            $view->courses = $courses;        
            $view->display('admin/header.php');
            $view->display('admin/courses/add.php');
            $view->display('admin/footer.php');
            
        }elseif ('edit' == $task && isset($id)) {
            
            if(!empty($_POST)){
                Courses::updateCourse($_POST);
            }
            
            $course = Courses::getCourse($id);
            $courses = Courses::getCourses();
            
            $view->courses = $courses; 
            $view->course = $course;
            
            $view->display('admin/header.php');
            $view->display('admin/courses/edit.php');
            $view->display('admin/footer.php');
            
        }elseif ('del' == $task) {
            Courses::delCourse($id);
            
            header('Location: /?ctrl=Admin&act=Courses');
            
        }else{
            $view->display('header.php');
            $view->display('404.php');
            $view->display('footer.php');
        }
        
    }
    
    public function actionLessons() {
        
        $tasks = [
            'Добавить'=>'show',
            'Добавить'=>'add',
            'Изменить'=>'edit',
            'Удалить'=>'del'
        ];
        
        $task = $_GET['task'];
        $id = $_GET['id'];
        
        $view = new View();
        $view->tasks = $tasks;
        
        if (!isset($task)){
            
            $lessons = Lessons::getLessons($id);
            $view->lessons = $lessons;
            
            $view->display('admin/header.php');
            $view->display('admin/lessons/list.php');
            $view->display('admin/footer.php');
            
        }elseif ('add' == $task) {
            if(!empty($_POST)){
                $id = Lessons::addLesson($_POST);
                header('Location: /?ctrl=Admin&act=Lessons&task=edit&id=' . $id);
            }
            
            $courses = Courses::getCourses();
            
            $view->courses = $courses;        
            $view->display('admin/header.php');
            $view->display('admin/lessons/add.php');
            $view->display('admin/footer.php');
            
        }elseif ('edit' == $task && isset($id)) {
            
            if(!empty($_POST)){
                Lessons::updateLesson($_POST);
            }
            
            $lesson = Lessons::getLesson($id);
            $courses = Courses::getCourses();
            
            $view->lesson = $lesson;
            $view->courses = $courses;
            
            
            $view->display('admin/header.php');
            $view->display('admin/lessons/edit.php');
            $view->display('admin/footer.php');
            
        }elseif ('del' == $task) {
            Courses::delCourse($id);
            
            header('Location: /?ctrl=Admin&act=Lessons');
            
        }else{
            $view->display('header.php');
            $view->display('404.php');
            $view->display('footer.php');
        }
        
    }
    
}