<?php
class Lessons extends AbstractModel {
    public static $table = 'lessons';
    
    
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
       
} 