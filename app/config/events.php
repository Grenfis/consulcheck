<?php

return [
    app\modules\telegram\events\GetUpdatesWasUnsuccessful::class => [
        app\modules\logger\listeners\LogWarnMessage::class,
    ]
];
