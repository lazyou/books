<?php

class StartSession implements Middleware
{
    public static function handle(Closure $next) 
    {
        echo "开启 session，获取数据 \n";
        $next();
        echo "保存数据，关闭 session \n";
    }
}
