<?php

class FirstStep implements Step
{
    public static function go(Closure $next) 
    {
        echo "开启 session，获取数据 \n";
        $next();
        echo "保存数据，关闭 session \n";
    }
}
