<?php

return [
    app\modules\common\events\LogMessage::class => [
        app\modules\logger\listeners\LogMessage::class,
    ],

    \app\modules\telegram\events\NewAdminUserAppears::class => [
        \app\modules\users\listeners\AddNewAdmin::class,
    ],
];
