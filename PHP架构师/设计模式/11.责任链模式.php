<?php

// TODO: 然而这样的实现 责任链模式的代码 不太行
class Board {
    protected $power = 1; // 权力级别
    protected $next = 'Admin'; // 下一级权力

    public function process($lev)
    {
        if ($lev <= $this->power) {
            echo "删帖 \n";
        } else {
            $next = new $this->next;
            $next->process($lev);
        }
    }
}

class Admin {
    protected $power = 2; // 权力级别
    protected $next = 'Police'; // 下一级权力

    public function process($lev)
    {
        if ($lev <= $this->power) {
            echo "封号 \n";
        } else {
            $next = new $this->next;
            $next->process($lev);
        }
    }
}

class Police {
    protected $power = 3; // 权力级别
    protected $next = null; // 没有下一级咋办?

    public function process($lev)
    {
        echo "报警 \n";
    }
}

$lev = 2;
$judge = new Board();
$judge->process($lev);
