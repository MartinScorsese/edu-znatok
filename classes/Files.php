<?php
class Files 
{
    
    protected $data = [];
    
    public function upload($file, $cat)
    {
        $file;
        $cat;
        
        $uploaddir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'courses' . DIRECTORY_SEPARATOR;
        
        if(is_uploaded_file($file['course_img']['tmp_name'])){
            move_uploaded_file($file['course_img']['tmp_name'], $uploaddir . $file['course_img']['name']);
        }
        
        return $img = '/img/courses/' . $file['course_img']['name'];
        
    }
    
}
