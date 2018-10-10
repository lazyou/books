<?php

// 注册自加载
spl_autoload_register('autoload');
function autoload($class)
{
    $class = explode('\\', $class);
    $class = end($class) . '.php';
    require $class;
}


// 实例化 IoC 容器
$app = new Container();

// 完成容器的填充
$app->bind("Visit", "Train");
$app->bind("traveller", "Traveller");

// $app->printBindings(); // 辅助理解

// 通过容器实现依赖注入, 完成类的实例化
$tra = $app->make("traveller");
$tra->visitTibet();
