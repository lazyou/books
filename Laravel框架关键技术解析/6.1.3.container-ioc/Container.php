<?php

// 设计容器类, 容器类装实例或者提供实例的回调函数
class Container
{
    // 用于装提供实例的回调函数, 真正的容器还会装实例等其他内容
    // 从而实现单例高等功能
    protected $bindings = [];

    // @abstract 绑定的别名
    // @concrete 实际绑定的类名
    // 绑定接口和生成相应实例的回调函数
    public function bind($abstract, $concrete = null, $shared = false)
    {
        if (!$concrete instanceof Closure) {
            // 如果提供的参数不是回调函数, 则产生默认的回调函数
            $concrete = $this->getClosure($abstract, $concrete);
        }

        $this->bindings[$abstract] = compact('concrete', 'shared');
    }

    // 打印 bindings
    public function printBindings()
    {
        print_r($this->bindings);
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

    // 实例化对象: 利用 PHP的反射机制
    public function build($concrete)
    {
        // 匿名类： http://php.net/manual/zh/class.closure.php
        if ($concrete instanceof Closure) {
            return $concrete($this);
        }

        // 类的反射： http://php.net/manual/zh/class.reflectionclass.php
        $reflector = new ReflectionClass($concrete);
        // 检查类是否可实例化
        if (! $reflector->isInstantiable()) {
            echo $message = "Target [$concrete] is not instantiable.";
        }

        // 获取类的构造函数: 返回值是一个 ReflectionMethod 对象，反射了类的构造函数，或者当类不存在构造函数时返回 NULL。
        // http://php.net/manual/zh/class.reflectionmethod.php
        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return new $concrete;
        }

        // 通过 ReflectionParameter 数组返回参数列表
        $dependencies = $constructor->getParameters();
        $instances = $this->getDependencices($dependencies);
        // 从给出的参数创建一个新的类实例
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
