### 安装
`composer require ryantao/api-response`
### 修改ENV
`RLOG_PATH = 绝对路径/相对路径`
### 日志配置
`config/rlog.php`
```
<?php

// +----------------------------------------------------------------------
// | 日志设置
// +----------------------------------------------------------------------
return [
    'test' => [
        // 处理默认通道的handler，可以设置多个
        'handlers' => [
            [
                // handler类的名字
                'class' => Monolog\Handler\RotatingFileHandler::class,
                // handler类的构造函数参数
                'constructor' => [
                    env('RLOG_PATH') . '/runtime/rlog/test.log',
                    30,
                    Monolog\Logger::DEBUG,
                ],
                // 格式相关
                'formatter' => [
                    // 格式化处理类的名字
                    'class' => Monolog\Formatter\LineFormatter::class,
                    // 格式化处理类的构造函数参数
                    'constructor' => [null, 'Y-m-d H:i:s', true],
                ],
            ]
        ],
    ]
];

```
test的日志通道相关配置
### 静态方法
`app/Library/RLog.php`
```
@method static void TerminationOrders(string $title, $context = [], string $type = 'info')
```
`添加静态方法即可，静态方法名需要和rlog.php中的配置对应`
### 使用示例
```
use lib\RLog;
Logger::test("hello",["a"=>"a","b"=>"b","c"=>"c","d"=>"d"]);
Logger::test("line");
```
# 强调
`不同的日志通道，需要在rlog.php 中额外配置，然后RLog.php中拷贝响应的静态方法`
