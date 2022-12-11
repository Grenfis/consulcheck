<?php

return [
    \app\modules\common\IDB::class => \app\modules\common\infrastructure\DB::class,

    \app\modules\checker\ISeleniumGateway::class => \app\modules\checker\infrastructure\SeleniumGateway::class,

    \app\modules\users\IUserRepository::class => \app\modules\users\infrastructure\UserGateway::class,

    \app\modules\telegram\ITelegramGateway::class => \app\modules\telegram\infrastructure\TelegramGateway::class,
    \app\modules\telegram\IGateway::class => \app\modules\telegram\infrastructure\Gateway::class,
];
