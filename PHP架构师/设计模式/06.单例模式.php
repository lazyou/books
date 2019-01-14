<?php
class Single
{
    protected static $ins = null;

    public static function getIns()
    {
        if (self::$ins === null) {
            // 实例化自己
            self::$ins = new self();
        }

        return self::$ins;
    }

    // 保证构造器不被覆盖, 也就是该类不能被继承
    final protected function __construct()
    {
    }

    // 封锁 clone()
    final protected function __clone()
    {
        echo "禁止 clone";
    }
}

$obj1 = Single::getIns();
$obj2 = Single::getIns();

if ($obj1 === $obj2) {
    echo "obj1 === obj2";
} else {
    echo "obj1 != obj2";
}
