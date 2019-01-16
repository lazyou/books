<?php

abstract class Info
{
    protected $send = null;

    // $send 是对象
    public function __construct($send)
    {
        $this->send = $send;
    }

    abstract public function msg($content);

    public function send($to, $content)
    {
        $content = $this->msg($content);
        $this->send->send($to, $content);
    }
}

// 发送内容
class Zn
{
    public function send($to, $content)
    {
        echo "站内: {$to} 内容: {$content}";
    }
}

class Email
{
    public function send($to, $content)
    {
        echo "邮件: {$to} 内容: {$content}";
    }
}

// 信息级别
class Commoninfo extends Info
{
    public function msg($content)
    {
       return "普通 {$content}";
    }
}

class Warninfo extends Info
{
    public function msg($content)
    {
        return "紧急 {$content}";
    }
}

// 使用
$info = new Commoninfo(new Zn());
$info->send('小明', "吃饭 \n");

$info = new Warninfo(new Email());
$info->send('小王', "跑路 \n");
