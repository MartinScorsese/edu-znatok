<?php
abstract class AbstractModel {
   
    protected static $table;
    protected static $class;

    
    public static function getAll(){
        
        $db = new DB;
        $query = "SELECT * FROM " . static::$table;
        return $db->queryAll($query, static::$class);
    }
    
    public static function getOne($id){
        $class = get_called_class();
        
        $db = new DB;

        $query = "SELECT * FROM " . static::$table . " WHERE id = '".$id."'";
        
        return $db->queryOne($query, static::$class);
    }
    
    /*
     * Метод найти все )))
     */
    public static function findAll()
    {
        $sql = 'SELECT * FROM ' . static::$table;
        $db = new DB();
        return $db->query($sql, static::$class);
    }
    
    public static function findOneByPK($id)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id=:id';
        $db = new DB();
        return $db->query($sql, [':id'=>$id], static::$class)[0];
    }
}
