<?php

namespace app\modules\telegram\infrastructure;

use app\modules\telegram\dto\TelegramGetUpdatesDto;
use app\modules\telegram\IGateway;
use app\modules\telegram\infrastructure\commands\user\AddAdminCommand;
use app\modules\telegram\infrastructure\commands\user\StartCommand;
use app\modules\telegram\ITelegramGateway;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;

class TelegramGateway implements ITelegramGateway
{
    private Telegram $telegram;

    /**
     * @throws TelegramException
     */
    public function __construct(IGateway $gateway)
    {
        $mysqlConfig = [
            'host' => DB_HOST,
            'port' => DB_PORT,
            'user' => DB_USER,
            'password' => DB_PASSWORD,
            'database' => DB_DATABASE,
        ];

        $this->telegram = new Telegram(TELEGRAM_BOT_KEY, TELEGRAM_BOT_USERNAME);
        $this->telegram->enableMySql($mysqlConfig, 'tg_');

        $this->telegram->addCommandClass(AddAdminCommand::class);
        $this->telegram->addCommandClass(StartCommand::class);

        $adminsIds = $gateway->getAdminIds();
        $this->telegram->enableAdmins($adminsIds);
    }

    /**
     * @throws TelegramException
     */
    public function getUpdates(): TelegramGetUpdatesDto
    {
        $result = $this->telegram->handleGetUpdates();
        return new TelegramGetUpdatesDto(
            $result->isOk(),
            $result->getDescription() ?: ''
        );
    }
}