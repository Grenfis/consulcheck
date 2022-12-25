<?php

require_once __DIR__ . '/constants.php';

use app\modules\bot\infrastructure\commands\admin\DDGCommand;
use app\modules\bot\infrastructure\commands\admin\E5Captcha;
use app\modules\bot\infrastructure\commands\admin\G10Captcha;
use app\modules\bot\infrastructure\commands\admin\G5Captcha;
use app\modules\bot\infrastructure\commands\user\AddAdminCommand;
use app\modules\bot\infrastructure\commands\user\Erevan5Command;
use app\modules\bot\infrastructure\commands\user\Gyumri10Command;
use app\modules\bot\infrastructure\commands\user\Gyumri5Command;
use app\modules\bot\infrastructure\commands\user\StartCommand;

const TELEGRAM_COMMANDS = [
    // USER
    ADD_ADMIN_COMMAND_NAME => AddAdminCommand::class,
    START_COMMAND_NAME => StartCommand::class,
    EREVAN_5_COMMAND_NAME => Erevan5Command::class,
    GYUMRI_5_COMMAND_NAME => Gyumri5Command::class,
    GYUMRI_10_COMMAND_NAME => Gyumri10Command::class,
    // ADMIN
    DDG_COMMAND_NAME => DDGCommand::class,
    G5_CAPTCHA_COMMAND_NAME => G5Captcha::class,
    G10_CAPTCHA_COMMAND_NAME => G10Captcha::class,
    E5_CAPTCHA_COMMAND_NAME => E5Captcha::class,
];
