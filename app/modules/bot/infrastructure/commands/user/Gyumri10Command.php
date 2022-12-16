<?php

namespace app\modules\bot\infrastructure\commands\user;

use app\modules\bot\events\UserWantsToGyumri10;
use app\modules\common\DI;
use app\modules\common\IEventDispatcher;
use Auryn\InjectionException;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

class Gyumri10Command extends UserCommand
{
    protected $name = 'gyumri_10';
    protected $description = 'Запись в Гюмри на 10 лет';
    protected $usage = '/gyumri_10';
    protected $version = '1.0.0';

    private IEventDispatcher $dispatcher;

    /**
     * @throws InjectionException
     */
    public function __construct(Telegram $telegram, ?Update $update = null)
    {
        $this->dispatcher = DI::instance()->make(IEventDispatcher::class);

        parent::__construct($telegram, $update);
    }

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $chatId = $message->getChat()->getId();
        $userId = $message->getFrom()->getId();
        $userName = $message->getFrom()->getUsername();

        $this->dispatcher->emit(new UserWantsToGyumri10($userId, $userName));

        return Request::sendMessage([
            'chat_id' => $chatId,
            'text' => 'Вы успешно добавленны в очередь',
        ]);
    }
}