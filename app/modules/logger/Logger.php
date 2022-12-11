<?php

namespace app\modules\logger;

use app\system\Common;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;

class Logger
{
    private static ?self $instance = null;

    private MonologLogger $logger;

    public function __construct()
    {
        $this->logger = new MonologLogger('main');

        $pathParts = [
            Common::getRoot(),
            '..',
            'logs',
            $this->logger->getName() . '.log'
        ];

        $this->logger->pushHandler(
            new StreamHandler(implode(DIRECTORY_SEPARATOR, $pathParts), MonologLogger::INFO)
        );
    }

    public static function instance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function warning(string $msg)
    {
        $this->logger->warning($msg);
    }

    public function info(string $msg)
    {
        $this->logger->info($msg);
    }
}