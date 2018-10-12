<?php

class CheckForMaintenanceMode implements Middleware
{
    public static function handle(Closure $next) 
    {
        echo "确定当前程序是否处于维护状态 \n";
        $next();
    }
}
