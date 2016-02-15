<?php
require_once __DIR__.'/../system/config.php';

class DB 
{
    private $dbh;
    private $className = 'stdClass';
    
    public function __construct(){
        $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset='.DB_CHARSET;
        $this->dbh = new PDO($dsn,DB_USER,DB_PASSWORD);
    } 
    /*
     * Устанавливает имя класса
     */
    public function setClassName($className){
        $this->className = $className;
    }
    /*
     *Возвращает результат запроса 
     */
    public function query($sql, $params=[]){
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_CLASS, $this->className);
    }
    /*
     * Выполняет запрос и возвращает true или false
     */
    public function execute($sql, $params=[]){
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($params);
    }
    /*
     * Возвращает ID последней добавленной записи
     */
    public function insert($sql, $params=[]){
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $this->dbh->lastInsertId();
    }
}
