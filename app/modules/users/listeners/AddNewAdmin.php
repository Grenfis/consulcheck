<?php

namespace app\modules\users\listeners;

use app\modules\common\events\EventsDispatcher;
use app\modules\common\events\LogMessage;
use app\modules\telegram\events\NewAdminUserAppears;
use app\modules\users\IUserRepository;
use app\modules\users\User;

class AddNewAdmin
{
    private IUserRepository $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(NewAdminUserAppears $event)
    {
        $user = new User(
            $event->userId(),
            $event->userName(),
            $event->firstName(),
            $event->lastName(),
            true,
            true,
            new \DateTime()
        );
        $this->repository->add($user);

        EventsDispatcher::instance()->emit(new LogMessage(
            'Новый админ добавлен! UserId = ' . $event->userId(),
            LogMessage::INFO
        ));
    }
}