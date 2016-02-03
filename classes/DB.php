<?php
require_once __DIR__.'/../system/config.php';

class DB 
{
    private $dbh;
    public function __construct(){
        $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset='.DB_CHARSET;
        $this->dbh = new PDO($dsn,DB_USER,DB_PASSWORD);
    } 
    
    public function query($sql, $params=[], $class='StdClass'){
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_CLASS, $class);
    }
    
    public function insert($sql, $params=[], $class='StdClass'){
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $this->dbh->lastInsertId();
    }
}
