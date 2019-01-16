<?php
// 装饰器模式做文章修饰功能
class BaseArt
{
    protected $content;

    protected $art = null;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function decorator()
    {
        return $this->content;
    }
}

// 小编 处理文章
class BianArt extends BaseArt
{
    public function __construct(BaseArt $art)
    {
        $this->art = $art;
        $this->decorator();
    }

    public function decorator()
    {
        return $this->content = $this->art->decorator() . " BianArt";
    }
}

// seo 处理文章
class SEOArt extends BaseArt
{
    public function __construct(BaseArt $art)
    {
        $this->art = $art;
        $this->decorator();
    }

    public function decorator()
    {
        return $this->content = $this->art->decorator() . " SEOArt";
    }
}

// 先小编处理, 再 seo 处理
$obj = new SEOArt(new BianArt(new BaseArt('文章内容')));
echo $obj->decorator() . "\n";

// 先 seo 处理, 再小编处理
$obj = new BianArt(new SEOArt(new BaseArt('文章内容')));
echo $obj->decorator() . "\n";
