<?php

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
