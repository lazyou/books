<?php

interface Step
{
    public static function go(Closure $next);
}
