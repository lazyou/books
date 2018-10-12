<?php

class XiaoFang implements Decorator
{
    private $name;

    public function __construct($name)
    {
        echo "XiaoFang: \n";
        $this->name = $name;
    }

    public function display()
    {
        echo "我是{$this->name}， 我出门了！！！ \n";
    }
}
