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
