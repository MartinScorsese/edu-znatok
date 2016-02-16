<?php
abstract class AbstractModel {
   
    protected static $table;
    protected $data = [];

    public function __set($k, $v){    
        $this->data[$k] = $v;
    }
    
    public function __get($k){    
        return $this->data[$k];
    }
    
    public function __isset($k) {    
        return isset($this->data[$k]);
    }
    
    
    public static function findAll(){
        
        $class = get_called_class();
        $db = new DB;
        $db->setClassName($class);
        $query = "SELECT * FROM " . static::$table;
        return $db->query($query);
    }
    
    public static function findAllByColumn($column, $value){
        $class = get_called_class(); 
        $db = new DB;
        $db->setClassName($class);
        $query = "SELECT * FROM " . static::$table . " WHERE " . $column . "=:value";
        $res = $db->query($query, [':value' => $value]);
        return $res;
    }
    
    public static function findOneByPK($id){
        
        $class = get_called_class();  
        $query = "SELECT * FROM " . static::$table . " WHERE id=:id";  
        $db = new DB;
        $db->setClassName($class);
        return $db->query($query, ['id' => $id])[0];
    }
    
    public static function findOneByColumn($column, $value){
        $class = get_called_class(); 
        $db = new DB;
        $db->setClassName($class);
        $query = "SELECT * FROM " . static::$table . " WHERE " . $column . "=:value";
        $res = $db->query($query, [':value' => $value]);
        if (empty($res)){
            $e = new ModelException();
            throw $e;
        }
        return $res[0];
    }
    
    private function insert(){
        $cols = array_keys($this->data);
        $data = [];
        foreach ($cols as $col) {
            $data[':' . $col] = $this->data[$col];
        }
        
        $query = "INSERT INTO "
                . static::$table . " "
                . "(" . implode(', ', $cols) .") "
                . "VALUES "
                . "(" . implode(', ', array_keys($data)) . ")";
        
        $db = New DB();
        $this->id = $db->insert($query, $data);
    }
    
    private function update(){
        $cols = [];
        $data =[];
        foreach ($this->data as $k => $v){
            $data[':' . $k] = $v;
            if ('id' == $k){
                continue;
            } 
            $cols[] = $k . '=:' . $k;
        }
       $query = "UPDATE " . static::$table . " "
                . "SET " . implode(', ', $cols) . " "
                . "WHERE id=:id";
        $db = New DB();
        $db->query($query, $data);
    }
    
    public function save(){
        if (isset($this->id)){
            $this->update();
        }else{
            $this->insert();
        }
    }
    
    public function delete(){
        $query = "DELETE FROM " . static::$table . " WHERE id=:id";
        $db = New DB();
        $db->execute($query, [':id' => $this->id]);
    }
}
