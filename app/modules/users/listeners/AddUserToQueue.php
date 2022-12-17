<?php

namespace app\modules\users\listeners;

use app\modules\bot\events\UserWantsToErevan;
use app\modules\bot\events\UserWantsToGyumri10;
use app\modules\bot\events\UserWantsToGyumri5;
use app\modules\users\IGateway;
use app\modules\users\IRepository;

class AddUserToQueue
{
    private IRepository $repository;
    private IGateway $gateway;

    public function __construct(IRepository $repository, IGateway $gateway)
    {
        $this->repository = $repository;
        $this->gateway = $gateway;
    }

    /**
     * @param UserWantsToErevan|UserWantsToGyumri5|UserWantsToGyumri10 $event
     * @return void
     * @throws \RuntimeException
     */
    public function __invoke($event)
    {
        $userId = $event->userId();
        switch (true) {
            case $event instanceof UserWantsToErevan:
                $queueId = QUEUE_EREVAN_5;
                break;

            case $event instanceof UserWantsToGyumri5:
                $queueId = QUEUE_GYUMRI_5;
                break;

            case $event instanceof UserWantsToGyumri10:
                $queueId = QUEUE_GYUMRI_10;
                break;

            default:
                throw new \RuntimeException("Не зарегистрирован такой обработчик события: userId = $userId, instance = " . get_class($event));
        }

        if (!$this->repository->exists($userId)) {
            throw new \RuntimeException("Пользователя $userId не существует!");
        }

        $this->gateway->addUserToQueue($userId, $queueId);
    }
}