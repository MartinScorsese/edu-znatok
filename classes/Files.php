<?php
class Files 
{   
    public function upload($file, $cat='courses')
    {
        $file;
        $cat;
        $file_pref = Helper::generateCode();
        $uploaddir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $cat . DIRECTORY_SEPARATOR;
        if(is_uploaded_file($file['img']['tmp_name'])){
            $new_file_name = explode('.', $file['img']['name']);
            $file_ext = array_pop($new_file_name);
            move_uploaded_file($file['img']['tmp_name'], $uploaddir . $file_pref . '.' . $file_ext);
            
            return $img = 'img/' . $cat . '/' . $file_pref . '.' . $file_ext;
        }   
    }
    
    public function delete($file)
    {
        
    }
}
