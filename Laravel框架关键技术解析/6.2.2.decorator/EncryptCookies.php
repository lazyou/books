<?php

class EncryptCookies implements Middleware
{
    public static function handle(Closure $next) 
    {
        echo "对输入请求的 cookie 进行解密 \n";
        $next();
        echo "对输出响应的 cookie 进行加密 \n";
    }
}
