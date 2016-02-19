<?php
/*Модуль в процессе написания. Имеет смысл делать после создания основного функционала приложения.*/
class Breadcrumbs 
{
    
       
    public function getCrumbs($item)
    {
        $paths = [
            'courses/?id=', 
            'lessons/show/?course_id=', 
            'lessons/lesson/?lesson_id='
        ];
        
        $crumbs[] = $item;
            if($item->parent_id){
                do{
                    $item = Courses::findOneByColumn('id', $item->parent_id);
                    $crumbs[] = $item;

                }while($item->parent_id); 
            }
        $crumbs = array_reverse($crumbs);
        
        $count = count($crumbs);
        
        $breadcrumbs = [];
        for ($i = 0; $i < $count; $i++){
            
            if(isset($crumbs[$i]->id)){
                $paths[$i] = $paths[$i] . $crumbs[$i]->id;
                $breadcrumbs[$i]['name'] = $crumbs[$i]->name;
            }
            $breadcrumbs[$i]['path'] = $paths[$i];   
        }
        
        return $breadcrumbs;
    }
    
}