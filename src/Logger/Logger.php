<?php

namespace Ryantao\Logger;

use Ryantao\Support\Log;


class Logger
{
    protected static $defaultLevel = 'info';

    /**
     * @throws Throwable
     */
    public static function __callStatic($name, $arguments)
    {
        $title = $arguments[0] ?? "";
        $level = $arguments[2] ?? static::$defaultLevel;
        $context = $arguments[1] ?? [];
        try {
            $logChannel = Log::channel($name);
        } catch (Throwable $e) {
            if ($e->getMessage() === 'Undefined index: ' . $name) {
                if (!in_array($name, config('rlog', []), true)) {
                    throw new InvalidArgumentException('请先在 config/rlog.php 配置中配置日志通道');
                }
                return;
            }
            throw $e;
        }
        if ($arguments[0] === 'line') {
            $line = str_repeat('-', 100);
            $logChannel->log($level, $line);
        } else {
            $logChannel->log($level, $title . " >>> " . self::formatMessage($context));
        }
    }

    /**
     * 格式化日志信息
     * @param $context
     * @return string
     */
    protected static function formatMessage($context): string
    {
        if (is_array($context)) {
            $context = json_encode($context, 320);
        }
        return $context;
    }
}

