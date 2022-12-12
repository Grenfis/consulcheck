<?php

namespace app\modules\users\listeners;

use app\modules\bot\events\NewAdminUserAppears;
use app\modules\common\ILogger;
use app\modules\users\IGateway;
use app\modules\users\IUserRepository;
use app\modules\users\User;

class AddNewAdmin
{
    private IUserRepository $repository;
    private IGateway $gateway;
    private ILogger $logger;

    public function __construct(IUserRepository $repository, ILogger $logger, IGateway $gateway)
    {
        $this->repository = $repository;
        $this->logger = $logger;
        $this->gateway = $gateway;
    }

    public function __invoke(NewAdminUserAppears $event)
    {
        $exists = $this->repository->exists($event->userId());

        if (!$exists) {
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
        } else {
            $this->gateway->setAdminStatus($event->userId(), true);
        }

        $this->logger->info('Новый админ добавлен! UserId = ' . $event->userId());
    }
}