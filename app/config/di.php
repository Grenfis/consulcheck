<?php

return [
    \app\modules\common\IDB::class => \app\modules\common\infrastructure\DB::class,
    \app\modules\common\ILogger::class => \app\modules\logger\Logger::class,
    \app\modules\common\IEventDispatcher::class => \app\modules\events\EventDispatcher::class,

    \app\modules\selenium\ISeleniumClient::class => \app\modules\selenium\infrastructure\SeleniumClient::class,

    \app\modules\users\IRepository::class => \app\modules\users\infrastructure\Repository::class,
    \app\modules\users\IGateway::class => \app\modules\users\infrastructure\Gateway::class,

    \app\modules\bot\ITelegramGateway::class => \app\modules\bot\infrastructure\TelegramGateway::class,
    \app\modules\bot\IGateway::class => \app\modules\bot\infrastructure\Gateway::class,

    \app\modules\checker\IErevanGateway::class => \app\modules\checker\infrastructure\ErevanGateway::class,
    \app\modules\checker\IGyumriGateway::class => \app\modules\checker\infrastructure\GyumriGateway::class,
];
