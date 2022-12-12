<?php

return [
    \app\modules\bot\events\NewAdminUserAppears::class => [
        \app\modules\users\listeners\AddNewAdmin::class,
    ],
];
