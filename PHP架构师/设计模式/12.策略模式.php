<?php

interface Math
{
    public function calc($op1, $op2);
}

class MathAdd implements Math
{
    public function calc($op1, $op2)
    {
        return $op1 + $op2;
    }
}

class MathSub implements Math
{
    public function calc($op1, $op2)
    {
        return $op1 - $op2;
    }
}

class MathMul implements Math
{
    public function calc($op1, $op2)
    {
        return $op1 * $op2;
    }
}

class MathDiv implements Math
{
    public function calc($op1, $op2)
    {
        return $op1 / $op2;
    }
}

// 封装一个虚拟计算器
class CMath
{
    protected $calc = null;

    public function __construct($type)
    {
        $calc = 'Math' . $type;
        $this->calc = new $calc();
    }

    public function calc($op1, $op2)
    {
        return $this->calc->calc($op1, $op2);
    }
}

//  使用
$cmath = new CMath('Add');
echo $cmath->calc(1, 2);
