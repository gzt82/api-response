### 安装
    composer require ryantao/api-response
### 修改ENV
    RLOG_PATH = 绝对路径/相对路径
### 日志配置
config下修改rlog.php
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
                        env('RLOG_PATH') . '/runtime/rlog/.log',
                        30,
                        Monolog\Logger::DEBUG,
                    ],
                    // 格式相关
                    'formatter' => [
                        // 格式化处理类的名字
                        'class' => Monolog\Formatter\LineFormatter::class,
                        // 格式化处理类的构造函数参数
                        'constructor' => [ null, 'Y-m-d H:i:s', true],
                    ],
                ]
            ],
        ]
    ];
    
### 使用示例
    use Ryantao\Logger\Logger;
    Logger::test("hello",["a"=>"a","b"=>"b","c"=>"c","d"=>"d"]);
