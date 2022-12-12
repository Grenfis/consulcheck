<?php

namespace app\modules\logger;

use app\modules\common\ILogger;
use app\system\Common;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;

class Logger implements ILogger
{
    private static ?MonologLogger $logger = null;

    public function __construct()
    {
        if (!self::$logger) {
            self::$logger = new MonologLogger('main');

            $pathParts = [
                Common::getRoot(),
                '..',
                'logs',
                self::$logger->getName() . '.log'
            ];

            self::$logger->pushHandler(
                new StreamHandler(implode(DIRECTORY_SEPARATOR, $pathParts), MonologLogger::INFO)
            );
        }
    }

    public function warning(string $msg)
    {
        self::$logger->warning($msg);
    }

    public function info(string $msg)
    {
        self::$logger->info($msg);
    }
}