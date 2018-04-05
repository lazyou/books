<?php

// 连接本地的 Redis 服务
$redis = new Redis();

$redis->connect('127.0.0.1', 6379);

echo "Connection to server sucessfully";

// 查看服务是否运行
echo "Server is running: " . $redis->ping();
echo "\n\r";

// 设置 redis 字符串数据
$redis->set("tutorial-name", "Redis tutorial");
// 获取存储的数据并输出
echo "Stored string in redis:: " . $redis->get("tutorial-name");
echo "\n\r";


// 存储数据到列表中
$redis->lpush("tutorial-list", "Redis");
$redis->lpush("tutorial-list", "Mongodb");
$redis->lpush("tutorial-list", "Mysql");
// 获取存储的数据并输出
$arList = $redis->lrange("tutorial-list", 0 ,5);
echo "Stored string in redis";
print_r($arList);
echo "\n\r";

// Keys 实例
// 获取数据并输出
$arList = $redis->keys("*");
echo "Stored keys in redis:: ";
print_r($arList);
