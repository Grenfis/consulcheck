<?php

return [
    app\modules\common\ISeleniumGateway::class => app\modules\common\infrastructure\SeleniumGateway::class,
    app\modules\common\ITelegramGateway::class => app\modules\common\infrastructure\TelegramGateway::class,
];
