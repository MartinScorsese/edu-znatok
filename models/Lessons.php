<?php
class Lessons extends AbstractModel {
    public $lesson_course_id;
    public $lesson_name;
    public $lesson_description;
    public $lesson_progress;
    public $lesson_text;
    
    
    public function getLessons($course_id){
        
        $db = new DB;
        if(empty($course_id)){
            $query = "SELECT * FROM lessons";
        }else{
            $query = "SELECT * FROM lessons WHERE lesson_course_id=" . $course_id;
        }
        $date = $db->query($query);
        return $date;       
    }
    
    public function getLesson($id){    
        $db = new DB;
        $query = "SELECT * FROM lessons WHERE lesson_id=" . $id;
        $date = $db->query($query);
        return $date[0];       
    }
    
    public function delLesson($id){    
        $db = new DB;
        $query = "DELETE FROM lessons WHERE lesson_id=" . $id;
        $date = $db->query($query);
        return $date[0];       
    }
    
    public function addLesson(){
        
        $lesson_course_id = $_POST['lesson_course_id'];
        $lesson_name = $_POST['lesson_name'];
        $lesson_description = $_POST['lesson_description'];
        $lesson_text = $_POST['lesson_text'];
        
        $db = new DB;
        
        $query = "INSERT INTO lessons (lesson_course_id, "
                . "lesson_name, "
                . "lesson_description, "
                . "lesson_text) VALUES('"
                . $lesson_course_id ."', '"
                . $lesson_name ."', '"
                . $lesson_description ."', '"
                . $lesson_text ."')";
        
        $data = $db->insert($query);
        return $data;      
    }
    
    public function updateLesson($post){
        
        
        $db = new DB;
        $query = "UPDATE lessons SET "
                . "lesson_course_id='" . $post['lesson_course_id'] . "', "
                . "lesson_name='" . $post['lesson_name'] . "', "
                . "lesson_description='" . $post['lesson_description'] . "', "
                . "lesson_text='" . $post['lesson_text'] . "', "
                . "lesson_progress='" . $post['lesson_progress'] . "' "
                . "WHERE lesson_id=" . $post['lesson_id'];
        $db->query($query);
    } 
} 