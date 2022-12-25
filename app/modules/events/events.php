<?php

return [
    // BOT
    \app\modules\bot\events\NewAdminUsersAppears::class => [
        \app\modules\users\listeners\AddNewAdmins::class,
    ],
    \app\modules\bot\events\UsersWantsToQueue::class => [
        \app\modules\users\listeners\AddUsersToQueue::class,
    ],
    \app\modules\bot\events\DDGSolutionWasReceived::class => [
        \app\modules\checker\listeners\SolveDDGCaptcha::class,
    ],
    \app\modules\bot\events\GeneralSolutionWasReceived::class => [
        \app\modules\checker\listeners\SolveGeneralCaptcha::class,
    ],

    // CHECKER
    \app\modules\checker\events\DDOSCaptchaWasFound::class => [
        \app\modules\bot\listeners\SolveDDOSCaptcha::class,
    ],
    \app\modules\checker\events\Gyumri5CaptchaWasFound::class => [
        \app\modules\bot\listeners\SolveGyumri5Captcha::class,
    ],
    \app\modules\checker\events\Gyumri5WasFindPlaces::class => [
        \app\modules\bot\listeners\Gyumri5SendPlaces::class,
    ],
    \app\modules\checker\events\Gyumri10CaptchaWasFound::class => [
        \app\modules\bot\listeners\SolveGyumri10Captcha::class,
    ],
    \app\modules\checker\events\Gyumri10WasFindPlaces::class => [
        \app\modules\bot\listeners\Gyumri10SendPlaces::class,
    ],
    \app\modules\checker\events\ErevanCaptchaWasFound::class => [
        \app\modules\bot\listeners\SolveErevanCaptcha::class,
    ],
    \app\modules\checker\events\ErevanWasFindPlaces::class => [
        \app\modules\bot\listeners\ErevanSendPlaces::class,
    ],
];
