<?php

namespace app\modules\bot\infrastructure\commands\user;

require_once __DIR__ . '/../constants.php';

use app\modules\common\DI;
use app\modules\common\ILogger;
use Auryn\InjectionException;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

class AddAdminCommand extends UserCommand
{
    protected $name = ADD_ADMIN_COMMAND_NAME;
    protected $description = 'Стать администратором проекта';
    protected $usage = '/' . ADD_ADMIN_COMMAND_NAME;
    protected $version = '1.0.0';

    private ILogger $logger;

    /**
     * @throws InjectionException
     */
    public function __construct(Telegram $telegram, ?Update $update = null)
    {
        $this->logger = DI::instance()->make(ILogger::class);

        parent::__construct($telegram, $update);
    }

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();

        $userId = $message->getFrom()->getId();
        $userName = $message->getFrom()->getUsername();

        $chatId = $message->getChat()->getId();

        $authKey = trim($message->getText(true));

        if ($authKey === TELEGRAM_ADMIN_PASSWORD) {
            $response = [
                'chat_id' => $chatId,
                'text' => 'Вы теперь новый администратор.'
            ];
            $this->getConfig(ADD_NEW_ADMIN_FUNC)($userId, $userName);
            return Request::sendMessage($response);
        }

        $this->logger->warning("Попытка стать администратором: user_id = $userId, chat_id = $chatId");
        $response = [
            'chat_id' => $chatId,
            'text' => 'Неавторизованная операция. Об инциденте будет сообщено администратору.'
        ];
        return Request::sendMessage($response);
    }
}