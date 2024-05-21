### 安装
    composer require ryantao/api-response
### 修改ENV
    RLOG_PATH = 绝对路径/相对路径
### 日志配置
拷贝 config目录的rlog.php
### 通道类
拷贝 lib目录到项目的指定扩展目录
### 使用示例
    use lib\RLog;
    Logger::test("hello",["a"=>"a","b"=>"b","c"=>"c","d"=>"d"]);
# 强调
不同的日志通道，需要在rlog.php 中额外配置，然后RLog.php中拷贝响应的静态方法
