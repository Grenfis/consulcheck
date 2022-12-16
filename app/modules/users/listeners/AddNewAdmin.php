<?php

namespace app\modules\users\listeners;

use app\modules\bot\events\NewAdminUserAppears;
use app\modules\common\ILogger;
use app\modules\users\IGateway;
use app\modules\users\IRepository;
use app\modules\users\UserService;

class AddNewAdmin
{
    private ILogger $logger;
    private IRepository $repository;
    private UserService $service;
    private IGateway $gateway;

    public function __construct(ILogger $logger, IRepository $repository, UserService $service, IGateway $gateway)
    {
        $this->logger = $logger;
        $this->repository = $repository;
        $this->service = $service;
        $this->gateway = $gateway;
    }

    public function __invoke(NewAdminUserAppears $event)
    {
        $exists = $this->repository->exists($event->userId());

        if (!$exists) {
            $this->service->createUser($event->userId(), $event->userName(), true);
        } else {
            $this->gateway->setAdminStatus($event->userId(), true);
        }

        $this->logger->info('Новый админ добавлен! UserId = ' . $event->userId());
    }
}