<?php
// 被观察者
class User implements SplSubject
{
    public $lognum;
    public $hobby;

    protected $observers = null;

    public function __construct($hobby)
    {
        $this->lognum = rand(1, 10);
        $this->hobby = $hobby;
        $this->observers = new SplObjectStorage();
    }

    public function login()
    {
        // 登陆相关操作, session

        // MUST
        $this->notify();
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        $this->observers->rewind();

        while ($this->observers->valid()) {
            $observer = $this->observers->current();
            $observer->update($this);
            $this->observers->next();
        }
    }
}

// 观察登陆次数, 做出对应警告
class Security implements SplObserver
{
    public function update(SplSubject $subject)
    {
        if ($subject->lognum < 3) {
            echo "这是第 {$subject->lognum} 次【安全】登陆 \n";
        } else {
            echo "这是第 {$subject->lognum} 次登陆【异常】 \n";
        }
    }
}

// 观察爱好, 推送对应的广告
class Advertise implements SplObserver
{
    public function update(SplSubject $subject)
    {
        if ($subject->hobby == 'sports') {
            echo "赠送球票 \n";
        } else {
            echo "赠送课程 \n";
        }
    }
}

// 使用观察
$user = new User('sports');
$user->attach(new Security());
$user->attach(new Advertise());
$user->login();

// 使用观察
$user = new User('study');
$user->attach(new Security());
$user->attach(new Advertise());
$user->login();
