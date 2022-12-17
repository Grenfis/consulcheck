<?php

namespace app\modules\bot\infrastructure\commands\user;

require_once __DIR__ . '/../constants.php';

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

class Gyumri5Command extends UserCommand
{
    protected $name = GYUMRI_5_COMMAND_NAME;
    protected $description = 'Запись в Гюмри на 5 лет';
    protected $usage = '/' . GYUMRI_5_COMMAND_NAME;
    protected $version = '1.0.0';


    public function __construct(Telegram $telegram, ?Update $update = null)
    {
        parent::__construct($telegram, $update);
    }

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $chatId = $message->getChat()->getId();
        $userId = $message->getFrom()->getId();
        $userName = $message->getFrom()->getUsername();

        $this->getConfig(ADD_TO_QUEUE_FUNC)($userId, $userName, 'gyumri_5');

        return Request::sendMessage([
            'chat_id' => $chatId,
            'text' => 'Вы успешно добавленны в очередь',
        ]);
    }
}