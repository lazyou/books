## 1.集群的设计思路和常用的技术
* web 服务器:
    * nignx: 高并发
    * lighttpd: 静态页和图片服务器

* 负载均衡: 转发请求到后端服务器
    * 软件: 
        * lvs / harproxy: 第四层, 所有基于 tcp/ip 的服务器都可以做负载均衡 (web, 数据库, 视频, 网站游戏等); 
        * nginx: 第七层, 只能左web服务器负载均衡;
    * 硬件: 稳定, 性能好; 但贵.

* 负载均衡转发策略:
    * 轮询

* 负载均衡健康检查机制:
    * 某一个web服务器转发失败几次后不再转发

* 反向代理服务器: 负载均衡服务器 与 web 服务器之间 加一个 反向代理服务器(做代理, __少见__)
    * varnish
    * squid
    * 穿透: 配置某些动态的页面不缓存, 比如登陆 搜索等

* 集群:
    * web 服务器集群
    * 数据库 服务器集群 (一般查群较多, 所以可以加缓存, 或 读写分离 -- 基于mysql主从配置)
        * 读写分离: 业务代码层面实现
        * mysql主从: 配置mysql程序服务器

* 一切都为了减少 数据库的连接, 所以数据库服务器要买好的

* 磁盘阵列: 硬盘的集群
    * RAID0
    * RAID1
    * RAID5
    * RAID1+0

## 2.lnmp环境的搭建



## 3.lnmp环境的使用-上传项目到lnmp中运行
* 删除 mysql 的默认匿名用户 (没有用户名也没有密码的用户)
    * 更新用户密码可使用 mysql 内置方法`password('xxx')`

* `ps -aux | grep nginx`

* `netstat -anpl | grep 3306` -- 没效果啊

* `ulimit -a` // open files 每个进程最大打开文件数量
    * `ulimit -SHn 65535` // 修改 open files

* nginx http 配置:

* nginx server 站点配置项:
    * listen
    * index
    * root
    * location
    * log_format
    * access_log


## 4.session丢失的问题
* 集群情况下 session 丢失
    * 被负载均衡转发到不同的服务器, 所以 session 不好使了

* 解决:
    * 方法一. 程序上解决: session 存储到数据库或redis;
    * 方法二. 负载均衡使用 ip_hash 策略;

## 5.mysql主从复制


