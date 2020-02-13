<?php
namespace application\config;
use PDO;
class Db{

    public static function dbconnect(){
        $opt = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false);
        $host='localhost';
        $dbname='study';
        $user='root';
        $password="";
        $charset = 'utf8';
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        return new PDO($dsn,$user,$password,$opt);
    }

}