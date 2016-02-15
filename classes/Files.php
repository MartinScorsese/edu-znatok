<?php
class Files 
{   
    public function upload($file, $cat='courses')
    {
        $file;
        $cat;
        $file_pref = Users::generateCode();
        $uploaddir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $cat . DIRECTORY_SEPARATOR;
        if(is_uploaded_file($file['img']['tmp_name'])){
            move_uploaded_file($file['img']['tmp_name'], $uploaddir . $file_pref . $file['img']['name']);
        }
        
        return $img = 'img/' . $cat . '/' . $file_pref . $file['img']['name'];
        
    }
    
}
