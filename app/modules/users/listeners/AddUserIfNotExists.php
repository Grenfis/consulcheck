<?php

namespace app\modules\users\listeners;

use app\modules\bot\events\UserWantsToErevan;
use app\modules\bot\events\UserWantsToGyumri10;
use app\modules\bot\events\UserWantsToGyumri5;
use app\modules\users\IRepository;
use app\modules\users\UserService;

class AddUserIfNotExists
{
    private UserService $service;
    private IRepository $repository;

    public function __construct(UserService $service, IRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * @param UserWantsToErevan|UserWantsToGyumri5|UserWantsToGyumri10 $event
     * @return void
     */
    public function __invoke($event)
    {
        $userId = $event->userId();
        $userName = $event->userName();

        if ($this->repository->exists($userId)) {
            return;
        }

        $this->service->createUser($userId, $userName, false);
    }
}