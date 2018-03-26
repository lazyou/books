<?php
/**
 * redis 订阅端: https://www.jianshu.com/p/cec941a228a6
 */

$redis = new Redis();

$redis->connect('localhost', 6379);

$redis->subscribe(['order'], function ($redis, $chan, $msg) {
    var_dump($redis);
    var_dump($chan);
    var_dump($msg);
});
