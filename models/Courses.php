<?php
class Courses extends AbstractModel {
    
    public static $table = 'courses';
    public static $class = 'Courses';
    
    public function getCourses(){
        
        $db = new DB;
        $query = "SELECT * FROM courses";
        $date = $db->query($query);
        return $date;       
    }
    
    public function getParentCourses($id=0){
        
        $db = new DB;
        $db->setClassName(self::$class);
        $date = $db->query("SELECT * FROM courses WHERE parent_id=:id", ['id' => $id]);
        return $date;       
    }
    
    public function getCourse($id){    
        $db = new DB;
        $query = "SELECT * FROM courses WHERE id=" . $id;
        $date = $db->query($query);
        return $date[0];       
    }
    
    public function delCourse($id){    
        $db = new DB;
        $query = "DELETE FROM courses WHERE id=" . $id;
        $date = $db->query($query);
        return $date[0];       
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