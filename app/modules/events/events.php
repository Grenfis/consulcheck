<?php

return [
    \app\modules\bot\events\NewAdminUsersAppears::class => [
        \app\modules\users\listeners\AddNewAdmins::class,
    ],

    \app\modules\bot\events\UsersWantsToQueue::class => [
        \app\modules\users\listeners\AddUsersToQueue::class,
    ],
];
