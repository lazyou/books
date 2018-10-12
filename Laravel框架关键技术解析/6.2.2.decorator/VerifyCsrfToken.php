<?php

class VerifyCsrfToken implements Middleware
{
    public static function handle(Closure $next) 
    {
        echo "验证 Csrf-Token \n";
        $next();
    }
}