## Code Examples
* https://github.com/codeguy/modern-php

* https://phptherightway.com/

## 目录
```
## 第2章 特性
* 命名空间 (php5.3)
    * namespace
    * use ... as ...;
    * use func ...;
    * use constant ...;
    * 自动载入： PSR-4 自动载入标准 (PHP-FIG)

* 使用接口
    * interface

* 性状 (php5.6)
    * trait
    * use XxxTrait;

* 生成器 (php5.5)
    * yield

* 闭包 (php5.3)
    * 闭包是指在创建时封装周围状态的函数.
    * 即便闭包所在的环境不存在了，闭包中封装的状态依旧存在.
    * 理论上，闭包和匿名函数是不同的概念。(但是PHP将其视作相同的概念)
    * 闭包是 Closure 类的实例
    * 之所以能调用 $closure 变量，因为这个变量的值是一个闭包，且闭包实现了 `__invoke()` 魔术方法。只要变量名后有 `()`，PHP就会查找并调用 `__invoke()` 方法.
    * 附加状态: `use`关键字， `bindTo()` 方法。

* Zend OPCaChe (php5.5 起内置)

* 内置的HTTP服务器 (php5.4)
    * `php -S 127.0.0.1:8000` 注意这种方式加载的配置是 cli 的 /etc/php/7.0/cli/php.ini
    * `php -S 127.0.0.1:8000 -c app/php.ini` 加载指定配置
    * `php -S 127.0.0.1:8000 run.php` 启动指定文件
    ```
    Server API	Built-in HTTP server
    Virtual Directory Support	disabled
    Configuration File (php.ini) Path	/etc/php/7.0/cli
    Loaded Configuration File	/etc/php/7.0/cli/php.ini
    Scan this dir for additional .ini files	/etc/php/7.0/cli/conf.d
    ```
    * 是否配置服务器判断: `php_sapi_name() == 'cli-server'`

* 启动这个服务器
* 配置这个服务器
* 查明使用的是否为内置的服务器

## 第二部分良好实践

## 第3章 标准
* 打破旧局面的PHP—FIG
* 框架的互操作性
* PSR是什么？
* PSR—1：基本的代码风格
* PSR—2：严格的代码风格
* PSR—3：日志记录器接口
* PSR—4：自动加载器

## 第4章 组件
* 为什么使用组件？
* 组件是什么？
* 组件和框架对比
* 查找组件
* 使用PHP组件

## 第5章 良好实践
* 过滤、验证和转义
* 密码
* 日期、时间和时区
* 数据库
* 多字节字符串
* 流
* 错误和异常

## 第三部分部署、测试和调优

## 第6章 主机
* 共享服务器
* 虚拟私有服务器
* 专用服务器
* PaaS
* 选择主机方案

## 第7章 配置
* 我们的目标
* 设置服务器
* SSH密钥对认证
* PHP—FPM
* 自动配置服务器
* 委托别人配置服务器
* 延伸阅读

## 第8章 调优
* php.ini文件
* 内存
* Zend OPCaChe
* 文件上传
* 最长执行时间
* 处理会话
* 缓冲输出
* 真实路径缓存

## 第9章 部署
* 版本控制
* 自动部署
* Capistrano
* 延伸阅读

## 第10章 测试
* 为什么测试？
* 何时测试？
* 测试什么？
* 如何测试？
* PHPUnit
* 使用Travis CI持续测试
* 延伸阅读

## 第11章 分析
* 什么时候使用分析器
* 分析器的种类
* XdebUg
* XHProf
* XHGUI
* New Relic的分析器
* Blackfire分析器
* 延伸阅读

## 第12章 HHVM和Hack
* HHVM
* Hack语言
* 延伸阅读

## 第13章 社区
* 本地PHP用户组
* 会议
* 辅导
* 与时俱进
```
