<?php

class AddQueuedCookieToResponse implements Middleware
{
    public static function handle(Closure $next) 
    {
        $next();
        echo "添加下一次请求需要的 cookie \n";
    }
}
