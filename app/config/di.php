<?php

return [
    \app\modules\checker\ISeleniumGateway::class => \app\modules\checker\infrastructure\SeleniumGateway::class,
    \app\modules\telegram\ITelegramGateway::class => \app\modules\telegram\infrastructure\TelegramGateway::class,
];
