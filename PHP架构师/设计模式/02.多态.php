<?php

class Tiger
{
    public function climb()
    {
    }
}

class Cat extends Tiger
{
    public function climb()
    {
        echo "Cat clib \n\r";
    }
}

class Duck extends Tiger
{
    public function climb()
    {
        echo "Duck clib \n\r";
    }
}

// 多态
class Client
{
    // 限定 call 的传递参数为 Cat Duck 的父类, 这样既能灵活传参, 又能保证参数的正确性
    public static function call(Tiger $animal)
    {
        $animal->climb();
    }
}

Client::call(new Cat());
Client::call(new Duck());
