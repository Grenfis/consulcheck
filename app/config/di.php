<?php

return [
    \app\modules\checker\ISeleniumGateway::class => app\modules\common\infrastructure\SeleniumGateway::class,
    \app\modules\telegram\ITelegramGateway::class => app\modules\common\infrastructure\TelegramGateway::class,
];
