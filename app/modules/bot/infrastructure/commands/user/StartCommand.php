<?php

namespace app\modules\bot\infrastructure\commands\user;

require_once __DIR__ . '/../constants.php';

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;
use PhpTelegramBot\FluentKeyboard\ReplyKeyboard\KeyboardButton;
use PhpTelegramBot\FluentKeyboard\ReplyKeyboard\ReplyKeyboardMarkup;

class StartCommand extends UserCommand
{
    protected $name = START_COMMAND_NAME;
    protected $description = 'Меню';
    protected $usage = '/' . START_COMMAND_NAME;
    protected $version = '1.0.0';

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $chatId = $message->getChat()->getId();

        $keyboard = ReplyKeyboardMarkup::make()
            ->row([
                KeyboardButton::make('/erevan_5 - Ереван 5 лет'),
            ])
            ->row([
                KeyboardButton::make('/gyumri_5 - Гюмри 5 лет'),
            ])
            ->row([
                KeyboardButton::make('/gyumri_10 - Гюмри 10 лет'),
            ]);

        return Request::sendMessage([
            'chat_id' => $chatId,
            'text' => 'Выберите место',
            'reply_markup' => $keyboard,
        ]);
    }
}