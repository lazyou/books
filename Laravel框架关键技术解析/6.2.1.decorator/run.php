<?php

// 注册自加载
spl_autoload_register('autoload');
function autoload($class)
{
    $class = explode('\\', $class);
    $class = end($class) . '.php';
    require $class;
}

$xiaofang = new XiaoFang("小芳");
$shoes = new Shoes($xiaofang);
$skirt = new Skirt($shoes);
$fire = new Fire($skirt);
$fire->display();

/*
XiaoFang:
Finery:
Finery:
Finery:
Fire:
出门前先整理头发
Skirt:
穿上裙子
Shoes:
穿上鞋子
我是小芳， 我出门了！！！
*/
