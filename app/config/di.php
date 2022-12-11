<?php

return [
    app\modules\common\ISeleniumGateway::class => app\modules\common\infrastructure\SeleniumGateway::class,
    \app\modules\telegram\ITelegramGateway::class => app\modules\common\infrastructure\TelegramGateway::class,
];
