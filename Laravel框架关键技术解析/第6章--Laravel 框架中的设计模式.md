## 目录
```
### 第6 章 Laravel 框架中的设计模式… …………………………………………… 92
#### 6.1 服务容器… ……………………………………………………………………… 92
* 6.1.1 依赖与耦合 ………………………………………………………………………… 92
* 6.1.2 工厂模式 …………………………………………………………………………… 94
* 6.1.3 IoC 模式 …………………………………………………………………………… 95
#### 6.1.4 源码解析 …………………………………………………………………………… 99
* 6.2 请求处理管道简介… …………………………………………………………… 104
* 6.2.1 装饰者模式 ………………………………………………………………………… 105
* 6.2.2 请求处理管道 ……………………………………………………………………… 106
* 6.2.3 部分源码 …………………………………………………………………………… 110
```

## 第6 章 Laravel 框架中的设计模式… …………………………………………… 92
### 6.1 服务容器… ……………………………………………………………………… 92
* __服务容器__ 是整个系统功能调度配置的核心

#### 6.1.1 依赖与耦合 ………………………………………………………………………… 92
* __IoC (Inversion Of Control, 控制反转)__
    * 服务容器就相当于一个 IoC 容器, IoC 容器要从 __控制反转模式__ 说起
    
* __控制反转模式__: 用来解决系统组件间相互依赖关系的一种模式  

* 在一个组件内使用 `new` 关键字解决了 依赖问题, 却带来了高耦合问题, 所以:
    * 所以就要把 `new` 操作放在组件外部, 组件接收一个 __接口__, 依赖的 类 都实现这个 接口, 从而利用 _鸭子类型_ 的原理使组件接收的 类 更加灵活.

* eg:
```php
<?php
// 接口
interface Visit 
{
    public function go();   
}

// 接口的实现类 1
class Leg implements Visit
{
    public function go()
    {
        echo "go by Leg \n";
    }
}

// 接口的实现类 2
class Car implements Visit
{
    public function go()
    {
        echo "go by Car \n";
    }
}

// 外部组件 一
function componentOne() {
    $visit = new Leg();
    $visit->go(); // 虽然解决了依赖问题, 却带来了耦合: 组件内已经限定了使用 Leg 类
}

componentOne(); // 调用 

// 外部组件 二 -- IoC 接收一个 interface 类型作为参数
function componentTow(Visit $visit) {
    $visit->go();
}

// 组件外部决定组件内使用的 类
// 在系统运行期间, 讲这种依赖关系通过动态注入的方式实现, 这就是 IOC 模式的设计思想
$leg = new Leg();
componentTow($leg); 

$car = new Car();
componentTow($car);
```  


#### 6.1.2 工厂模式 …………………………………………………………………………… 94
* 从上面而知, 交通工具实例化过程是经常需要改变的, 所以将此提取到外部来管理.
    * 使用工厂模式实现, 当然也可以利用工厂方法模式

* eg:
```php
<?php

// 接口
interface Visit
{
    public function go();
}

// 接口的实现类 1
class Leg implements Visit
{
    public function go()
    {
        echo "go by Leg \n";
    }
}

// 接口的实现类 2
class Car implements Visit
{
    public function go()
    {
        echo "go by Car \n";
    }
}

class TrafficToolFactory
{
    public function createTrafficTool($name)
    {
        switch ($name) {
            case 'Leg':
                return new Leg();
                break;
            case 'Car':
                return new Car();
                break;
            default:
                exit('set trafficTool error!!!');
                break;
        }
    }
}

class Traveller
{
    protected $trafficTool;

    public function __construct($trafficTool)
    {
        // 通过工厂生产依赖的交通工具实例
        $factory = new TrafficToolFactory();
        $this->trafficTool = $factory->createTrafficTool($trafficTool);
    }

    public function visitTibet()
    {
        $this->trafficTool->go();
    }
}

$tra = new Traveller('Car');
$tra->visitTibet();
```

* "旅行者" 和 "交通工具" 之间的依赖关系没有了, 但变成了 "旅行者" 和 "交通工具工厂" 之间的依赖.
    * 当需求增加, 需要修改简单工厂模式, 随着依赖增多, 工厂将变得庞大不容易维护.


#### 6.1.3 IoC 模式 …………………………………………………………………………… 95


### 6.1.4 源码解析 …………………………………………………………………………… 99
#### 6.2 请求处理管道简介… …………………………………………………………… 104


#### 6.2.1 装饰者模式 ………………………………………………………………………… 105


#### 6.2.2 请求处理管道 ……………………………………………………………………… 106


#### 6.2.3 部分源码 …………………………………………………………………………… 110

