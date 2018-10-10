<?php

// 简单工厂模式，对于不同的输入，实例化不同的交通工具
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
