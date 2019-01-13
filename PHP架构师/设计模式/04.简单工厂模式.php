<?php

// 面向接口编程, 达到多态
interface db
{
    public function conn();
}

// 实现接口
class dbMysql implements db
{
    public function conn()
    {
        echo "db Mysql \n\r";
    }
}

class dbSqlite implements db
{
    public function conn()
    {
        echo "db Sqlite \n\r";
    }
}

// 简单工厂
class Factory
{
    public static function createDB($type)
    {
        if ($type == 'mysql') {
            return new dbMysql();
        } elseif ($type == 'sqlite') {
            return new dbSqlite();
        } else {
            throw new Exception("Error DB", 1);
        }
    }
}

$mysql = Factory::createDB('mysql');
$mysql->conn();

$sqlite = Factory::createDB('sqlite');
$sqlite->conn();
