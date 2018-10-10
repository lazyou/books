<?php

// 注册自加载
spl_autoload_register('autoload');
function autoload($class)
{
    $class = explode('\\', $class);
    $class = end($class) . '.php';
    require $class;
}

// 1: 外部组件 一 【耦合】
function componentOne() {
    $visit = new Leg();
    $visit->go(); // 虽然解决了依赖问题, 却带来了耦合: 组件内已经限定了使用 Leg 类
}

componentOne(); // 调用 

// 2: 外部组件 二 -- 【解藕】 IoC 接收一个 interface 类型作为参数
function componentTow(Visit $visit) {
    $visit->go();
}

// 组件外部决定组件内使用的 类
// 在系统运行期间, 讲这种依赖关系通过动态注入的方式实现, 这就是 IOC 模式的设计思想
$leg = new Leg();
componentTow($leg); 

$car = new Car();
componentTow($car);
