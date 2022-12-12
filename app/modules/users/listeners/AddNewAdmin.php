<?php

namespace app\modules\users\listeners;

use app\modules\bot\events\NewAdminUserAppears;
use app\modules\common\ILogger;
use app\modules\users\IUserRepository;
use app\modules\users\User;

class AddNewAdmin
{
    private IUserRepository $repository;
    private ILogger $logger;

    public function __construct(IUserRepository $repository, ILogger $logger)
    {
        $this->repository = $repository;
        $this->logger = $logger;
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

        $this->logger->info('Новый админ добавлен! UserId = ' . $event->userId());
    }
}