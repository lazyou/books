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

* eg: 详见 6.1.1.duck_typing


#### 6.1.2 工厂模式 …………………………………………………………………………… 94
* 从上面而知, 交通工具实例化过程是经常需要改变的, 所以将此提取到外部来管理.
    * 使用工厂模式实现, 当然也可以利用工厂方法模式

* eg: 详见 6.1.2.factory

* "旅行者" 和 "交通工具" 之间的依赖关系没有了, 但变成了 "旅行者" 和 "交通工具工厂" 之间的依赖.
    * 当需求增加, 需要修改简单工厂模式, 随着依赖增多, 工厂将变得庞大不容易维护.


#### 6.1.3 IoC 模式 …………………………………………………………………………… 95
* IoC (Inversion of Control)模式又称 __依赖注入__(Dependency Injection)模式

* 控制反转是将组件间的依赖关系从程序内部提取到外部容器来管理, 而依赖注入是指组件的依赖通过外部参数活其他形式注释, 两种说法本质上是一个意思.

* eg: 一个简单的依赖注入实例
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

class Traveller
{
    protected $trafficTool;

    public function __construct(Visit $trafficTool)
    {
        $this->trafficTool = $trafficTool;
    }

    public function visitTibet()
    {
        $this->trafficTool->go();
    }
}

$trafficTool = new Leg();
// 依赖注入的方式解决依赖问题
$tra = new Traveller($trafficTool);
$tra->visitTibet();
```

* 上述实例就是一个依赖注入的过程, Traveller 类的构造函数依赖一个外部具有的 Visit 接口的实例.
    * 依赖注入需要通过 __接口__ 来限制, 而不能随意开发, 这也体现了设计模式的另一个原则 -- 针对 __接口__ 编程, 而不是针对实现编程.
    
* 上面我们是通过 _手动注入依赖_ , 而通过 IoC 容器我们可以实现 _自动依赖注入_.

* eg: 实现 IoC 容器完成自动依赖注入 (Laravel 框架中的设计方法进行简化)
```php
<?php

// 设计容器类, 容器类装实例或者提供实例的回调函数
class Container
{
    // 用于装提供实例的回调函数, 真正的容器还会装实例等其他内容
    // 从而实现单例高等功能
    protected $bindings = [];

    // 绑定接口和生成相应实例的回调函数
    public function bind($abstract, $concrete = null, $shared = false)
    {
        if (!$concrete instanceof Closure) {
            // 如果提供的参数不是回调函数, 则产生默认的回调函数
            $concrete = $this->getClosure($abstract, $concrete);
        }

        $this->bindings[$abstract] = compact('concrete', 'shared');
    }

    // 默认生成实例的回调函数
    protected function getClosure($abstract, $concrete)
    {
        // 生成实例的回调函数, $c 一般为 IoC 容器对象, 在调用回调生成实例时提供
        // 即 build 函数中的 $concrete($this)
        return function ($c) use ($abstract, $concrete) {
            $method = ($abstract == $concrete) ? 'build' : 'make';

            // 调用的容器是 build 或 make 方法生成实例
            return $c->$method($concrete);
        };
    }

    // 生成实例对象, 首先解决接口和要实例化类之间的依赖关系
    public function make($abstract)
    {
        $concrete = $this->getConcrete($abstract);

        if ($this->isBuildable($concrete, $abstract)) {
            $object = $this->build($concrete);
        } else {
            $object = $this->make($concrete);
        }

        return $object;
    }

    protected function isBuildable($concrete, $abstract)
    {
        return $concrete === $abstract || $concrete instanceof Closure;
    }

    // 获取绑定的回调函数
    protected function getConcrete($abstract)
    {
        if (! isset($this->bindings[$abstract])) {
            return $abstract;
        }

        return $this->bindings[$abstract]['concrete'];
    }

    // 实例化对象
    public function build($concrete)
    {
        if ($concrete instanceof Closure) {
            return $concrete($this);
        }

        $reflector = new ReflectionClass($concrete);
        if (! $reflector->isInstantiable()) {
            echo $message = "Target [$concrete] is not instantiable.";
        }

        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return new $concrete;
        }

        $dependencies = $constructor->getParameters();
        $instances = $this->getDependencices($dependencies);
        return $reflector->newInstanceArgs($instances);
    }

    // 通过反射机制实例化对象时的依赖
    protected function getDependencices($parameters)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
        }

        if (is_null($dependency)) {
            $dependencies[] = null;
        } else {
            $dependencies[] = $this->resolveClass($parameter);
        }

        return (array) $dependencies;
    }

    protected function resolveClass(ReflectionParameter $parameter)
    {
        return $this->make($parameter->getClass()->name);
    }
}

// 使用 Ioc
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

// 接口的实现类 3
class Train implements Visit
{
    public function go()
    {
        echo "go by Train \n";
    }
}

class Traveller
{
    protected $trafficTool;

    public function __construct(Visit $trafficTool)
    {
        $this->trafficTool = $trafficTool;
    }

    public function visitTibet()
    {
        $this->trafficTool->go();
    }
}

// 实例化 IoC 容器
$app = new Container();

// 完成容器的填充
$app->bind("Visit", "Train");
$app->bind("traveller", "Traveller");

// 通过容器实现依赖注入, 完成类的实例化
$tra = $app->make("traveller");
$tra->visitTibet();
```

* TODO: 只是敲一遍, 还不太理解


### 6.1.4 源码解析 …………………………………………………………………………… 99
#### 6.2 请求处理管道简介… …………………………………………………………… 104


#### 6.2.1 装饰者模式 ………………………………………………………………………… 105


#### 6.2.2 请求处理管道 ……………………………………………………………………… 106


#### 6.2.3 部分源码 …………………………………………………………………………… 110

