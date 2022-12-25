<?php

namespace app\modules\bot\infrastructure\commands\admin;

require_once __DIR__ . '/../constants.php';

use Longman\TelegramBot\Commands\AdminCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class E5Captcha extends AdminCommand
{
    protected $name = E5_CAPTCHA_COMMAND_NAME;
    protected $description = 'Ввести решение каптчи Ереван 5 лет';
    protected $usage = '/' . E5_CAPTCHA_COMMAND_NAME;
    protected $version = '1.0.0';

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $userId = $message->getFrom()->getId();
        $text = $message->getText(true);

        $this->getConfig(SOLVE_GENERAL_CAPTCHA)($userId, $text, 'e');

        return Request::sendMessage([
            'chat_id' => $userId,
            'text' => 'Спасибо за ответ.',
        ]);
    }
}