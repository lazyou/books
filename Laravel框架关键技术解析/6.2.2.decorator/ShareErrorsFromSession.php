<?php

class ShareErrorsFromSession implements Middleware
{
    public static function handle(Closure $next) 
    {
        echo "如果 session 中有 errors 变量，则共享它 \n";
        $next();
    }
}
