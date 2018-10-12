<?php

// 注册自加载
spl_autoload_register('autoload');
function autoload($class)
{
    $class = explode('\\', $class);
    $class = end($class) . '.php';
    require $class;
}

function goFun($step, $className) 
{
    return function () use ($step, $className)
    {
        return $className::go($step);
    };
}

function then()
{
    $steps = [
        "FirstStep",
    ];

    $prepare = function () {
        echo "请求向路由器传递，返回响应 \n";
    };

    $go = array_reduce($steps, "goFun", $prepare);
    $go();
}

then();
