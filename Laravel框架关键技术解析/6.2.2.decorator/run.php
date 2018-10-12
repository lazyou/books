<?php

// 注册自加载
spl_autoload_register('autoload');
function autoload($class)
{
    $class = explode('\\', $class);
    $class = end($class) . '.php';
    require $class;
}

// 这个看起来简直太绕了
function getSlice()
{
    echo "0 \n";
    return function($stack, $pipe)
    {
        echo "1: {$pipe}\n";
        return function() use ($stack, $pipe)
        {
            echo "2: {$pipe}\n";
            return $pipe::handle($stack);
        };
    };
}

function then()
{
    $pipes = [
        "CheckForMaintenanceMode",
        "EncryptCookies",
        "AddQueuedCookieToResponse",
        "StartSession",
        "ShareErrorsFromSession",
        "VerifyCsrfToken",
    ];

    $firstSlice = function () {
        echo "请求向路由器传递，返回响应 \n";
    };

    // 既然要反序为什么不再 $pipes 就定义好顺序？
    $pipes = array_reverse($pipes);

    call_user_func(
        // http://php.net/manual/zh/function.array-reduce.php
        // 将回调函数 callback 迭代地作用到 array 数组中的每一个单元中，从而将数组简化为单一的值
        array_reduce($pipes, getSlice(), $firstSlice) // 不用再一个个传参了，利用函数实现递归
    );
}

then();

/*
确定当前程序是否处于维护状态
对输入请求的 cookie 进行解密
开启 session，获取数据
如果 session 中有 errors 变量，则共享它
验证 Csrf-Token
请求向路由器传递，返回响应
保存数据，关闭 session
添加下一次请求需要的 cookie
对输出响应的 cookie 进行加密
*/
