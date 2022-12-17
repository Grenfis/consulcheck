<?php

require_once __DIR__ . '/constants.php';

use app\modules\bot\infrastructure\commands\user\AddAdminCommand;
use app\modules\bot\infrastructure\commands\user\Erevan5Command;
use app\modules\bot\infrastructure\commands\user\Gyumri10Command;
use app\modules\bot\infrastructure\commands\user\Gyumri5Command;
use app\modules\bot\infrastructure\commands\user\StartCommand;

const TELEGRAM_COMMANDS = [
    ADD_ADMIN_COMMAND_NAME => AddAdminCommand::class,
    START_COMMAND_NAME => StartCommand::class,
    EREVAN_5_COMMAND_NAME => Erevan5Command::class,
    GYUMRI_5_COMMAND_NAME => Gyumri5Command::class,
    GYUMRI_10_COMMAND_NAME => Gyumri10Command::class,
];
