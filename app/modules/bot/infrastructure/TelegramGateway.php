<?php

namespace app\modules\bot\infrastructure;

require_once __DIR__ . '/commands/constants.php';
require_once __DIR__ . '/commands/telegramCommands.php';

use app\modules\bot\dto\TelegramGetUpdatesDto;
use app\modules\bot\IGateway;
use app\modules\bot\ITelegramGateway;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

class TelegramGateway implements ITelegramGateway
{
    private Telegram $telegram;
    private array $toQueue;
    private array $newAdmins;
    private array $solveDDG;

    private array $solveGeneralCaptcha;

    /**
     * @throws TelegramException
     */
    public function __construct(IGateway $gateway)
    {
        $this->toQueue = [];
        $this->newAdmins = [];
        $this->solveDDG = [];
        $this->solveGeneralCaptcha = [];

        $mysqlConfig = [
            'host' => DB_HOST,
            'port' => DB_PORT,
            'user' => DB_USER,
            'password' => DB_PASSWORD,
            'database' => DB_DATABASE,
        ];

        $this->telegram = new Telegram(TELEGRAM_BOT_KEY, TELEGRAM_BOT_USERNAME);
        $this->telegram->enableMySql($mysqlConfig, 'tg_');
        $this->initTelegramCommands();

        $adminsIds = $gateway->getAdminIds();
        $this->telegram->enableAdmins($adminsIds);
    }

    private function initTelegramCommands()
    {
        foreach(TELEGRAM_COMMANDS as $commandName => $commandClass) {
            $this->telegram->addCommandClass($commandClass);
            $this->telegram->setCommandConfig($commandName, [
                ADD_TO_QUEUE_FUNC => function(int $userId, string $userName, string $queue) {
                    $this->toQueue[] = [
                        'user_id' => $userId,
                        'user_name' => $userName,
                        'queue' => $queue,
                    ];
                },

                ADD_NEW_ADMIN_FUNC => function(int $userId, string $userName) {
                    $this->newAdmins[] = [
                        'user_id' => $userId,
                        'user_name' => $userName,
                    ];
                },

                SOLVE_DDG_CAPTCHA => function(int $userId, string $text) {
                    $this->solveDDG[] = [
                        'user_id' => $userId,
                        'text' => $text,
                    ];
                },

                SOLVE_GENERAL_CAPTCHA => function(int $userId, string $text, string $dest) {
                    $this->solveGeneralCaptcha[] = [
                        'user_id' => $userId,
                        'text' => $text,
                        'dest' => $dest,
                    ];
                }
            ]);
        }
    }

    /**
     * @throws TelegramException
     */
    public function getUpdates(): TelegramGetUpdatesDto
    {
        $result = $this->telegram->handleGetUpdates();

        return new TelegramGetUpdatesDto(
            $result->isOk(),
            $result->getDescription() ?: '',
            $this->newAdmins,
            $this->toQueue,
            $this->solveDDG,
            $this->solveGeneralCaptcha
        );
    }

    public function sendDDGMessageToAdmins(string $captchaPath)
    {
        $adminsIds = $this->telegram->getAdminList();
        foreach ($adminsIds as $id) {
            Request::sendDocument([
                'chat_id' => $id,
                'document' => $captchaPath,
                'caption' => 'DDG каптча. Для ответа введите /ddg'
            ]);
        }
    }

    public function sendGyumri5CaptchaMessageToAdmin(string $captchaPath)
    {
        $adminsIds = $this->telegram->getAdminList();
        foreach ($adminsIds as $id) {
            Request::sendDocument([
                'chat_id' => $id,
                'document' => $captchaPath,
                'caption' => 'Гюмри 5 лет каптча. Для ответа введите /g5c'
            ]);
        }
    }

    public function sendDocumentToUsers(string $caption, string $path, int ...$users)
    {
        foreach ($users as $user) {
            Request::sendDocument([
                'chat_id' => $user,
                'document' => $path,
                'caption' => $caption
            ]);
        }
    }
}