<?php
// 原接口输出的是序列化后的数据
class Tianqi
{
    public static function show()
    {
        $today = [
            'tmp' => 28,
            'wind' => 4,
            'sun' => 'sunny',
        ];

        return serialize($today);
    }
}

// 增加一个适配器: 序列化转为JSON
class AdapterTianqi extends Tianqi
{
    public static function show()
    {
        $today = parent::show();
        $today = json_encode(unserialize($today));
        return $today;
    }
}

var_dump(Tianqi::show());
var_dump(AdapterTianqi::show());
