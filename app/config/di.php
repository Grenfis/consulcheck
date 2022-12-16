<?php

return [
    \app\modules\common\IDB::class => \app\modules\common\infrastructure\DB::class,
    \app\modules\common\ILogger::class => \app\modules\logger\Logger::class,
    \app\modules\common\IEventDispatcher::class => \app\modules\events\EventDispatcher::class,

    \app\modules\checker\ISeleniumGateway::class => \app\modules\checker\infrastructure\SeleniumGateway::class,

    \app\modules\users\IRepository::class => \app\modules\users\infrastructure\Repository::class,
    \app\modules\users\IGateway::class => \app\modules\users\infrastructure\Gateway::class,

    \app\modules\bot\ITelegramGateway::class => \app\modules\bot\infrastructure\TelegramGateway::class,
    \app\modules\bot\IGateway::class => \app\modules\bot\infrastructure\Gateway::class,
];
