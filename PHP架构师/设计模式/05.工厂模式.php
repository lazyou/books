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

// 工厂接口
interface Factory
{
    public static function createDB();
}

// 实现工厂
class mysqlFactory implements Factory
{
    public static function createDB()
    {
        return new dbMysql();
    }
}

class sqliteFactory implements Factory
{
    public static function createDB()
    {
        return new dbSqlite();
    }
}

// 使用
$db = mysqlFactory::createDB();
$db->conn();

$db = sqliteFactory::createDB();
$db->conn();
