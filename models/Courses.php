<?php
class Courses extends AbstractModel {
    
    public $course_id;
    public $course_parent_id;
    public $course_name;
    public $course_description;
    public $course_img;
    
    
    public function getCourses(){
        
        $db = new DB;
        $query = "SELECT * FROM courses";
        $date = $db->query($query);
        return $date;       
    }
    
    public function getParentCourses($id=0){
        
        $db = new DB;
        $query = "SELECT * FROM courses WHERE course_parent_id=". $id;
        $date = $db->query($query);
        return $date;       
    }
    
    public function getCourse($id){    
        $db = new DB;
        $query = "SELECT * FROM courses WHERE course_id=" . $id;
        $date = $db->query($query);
        return $date[0];       
    }
    
    public function delCourse($id){    
        $db = new DB;
        $query = "DELETE FROM courses WHERE course_id=" . $id;
        $date = $db->query($query);
        return $date[0];       
    }
    
    public function addCourses(){
        
        $id = $_POST['id'];
        $parent_id = $_POST['course_parent_id'];
        $name = $_POST['course_name'];
        $description = $_POST['course_description'];
        $img = Files::upload($_FILES, 'courses');
        
        $db = new DB;
        
        $query = "INSERT INTO courses (course_id, "
                . "course_parent_id, "
                . "course_name, "
                . "course_description, "
                . "course_img) VALUES('"
                . $id ."', '"
                . $parent_id ."', '"
                . $name ."', '"
                . $description ."', '"
                . $img ."')";
        
        $data = $db->insert($query);
        return $data;      
    }
    
    public function updateCourse($post){
        
        if(!empty($_FILES)){
            $post['course_img'] = Files::upload($_FILES, 'courses');
        }
        
        $db = new DB;
        $query = "UPDATE courses SET "
                . "course_parent_id='" . $post['course_parent_id'] . "', "
                . "course_name='" . $post['course_name'] . "', "
                . "course_description='" . $post['course_description'] . "', "
                . "course_img='" . $post['course_img'] . "' "
                . "WHERE course_id=" . $post['course_id'];
        $db->query($query);
    }
    
} 