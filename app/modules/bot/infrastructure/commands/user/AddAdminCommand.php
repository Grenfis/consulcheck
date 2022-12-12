<?php

namespace app\modules\bot\infrastructure\commands\user;

use app\modules\common\events\EventsDispatcher;
use app\modules\common\events\LogMessage;
use app\modules\bot\events\NewAdminUserAppears;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class AddAdminCommand extends UserCommand
{
    protected $name = 'i_am_admin';
    protected $description = 'Стать администратором проекта';
    protected $usage = '/i_am_admin';
    protected $version = '1.0.0';

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();

        $userId = $message->getFrom()->getId();
        $userName = $message->getFrom()->getUsername();
        $firstName = $message->getFrom()->getFirstName();
        $lastName = $message->getFrom()->getLastName();

        $chatId = $message->getChat()->getId();

        $authKey = trim($message->getText(true));

        if ($authKey === TELEGRAM_ADMIN_PASSWORD) {
            $response = [
                'chat_id' => $chatId,
                'text' => 'Вы теперь новый администратор.'
            ];
            EventsDispatcher::instance()->emit(new NewAdminUserAppears(
                $userId,
                $userName,
                empty($firstName) ? null : $firstName,
                empty($lastName) ? null : $lastName
            ));
            return Request::sendMessage($response);
        }

        EventsDispatcher::instance()->emit(new LogMessage(
            "Попытка стать администратором: user_id = $userId, chat_id = $chatId",
            LogMessage::WARN
        ));
        $response = [
            'chat_id' => $chatId,
            'text' => 'Неавторизованная операция. Об инциденте будет сообщено администратору.'
        ];
        return Request::sendMessage($response);
    }
}