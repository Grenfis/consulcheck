<?php

return [
    \app\modules\bot\events\NewAdminUserAppears::class => [
        \app\modules\users\listeners\AddNewAdmin::class,
    ],

    \app\modules\bot\events\UserWantsToErevan::class => [
        \app\modules\users\listeners\AddUserIfNotExists::class,
        \app\modules\users\listeners\AddUserToQueue::class,
    ],

    \app\modules\bot\events\UserWantsToGyumri5::class => [
        \app\modules\users\listeners\AddUserIfNotExists::class,
        \app\modules\users\listeners\AddUserToQueue::class,
    ],

    \app\modules\bot\events\UserWantsToGyumri10::class => [
        \app\modules\users\listeners\AddUserIfNotExists::class,
        \app\modules\users\listeners\AddUserToQueue::class,
    ],
];
