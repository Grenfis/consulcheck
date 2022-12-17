<?php

namespace app\modules\users\listeners;

use app\modules\bot\events\NewAdminUsersAppears;
use app\modules\common\ILogger;
use app\modules\users\IGateway;
use app\modules\users\IRepository;
use app\modules\users\UserService;

class AddNewAdmins
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

    public function __invoke(NewAdminUsersAppears $event)
    {
        foreach ($event->users() as $user) {
            $userId = $user['user_id'];
            $userName = $user['user_name'];

            $exists = $this->repository->exists($userId);

            if (!$exists) {
                $this->service->createUser($userId, $userName, true);
            } else {
                $this->gateway->setAdminStatus($userId, true);
            }

            $this->logger->info('Новый админ добавлен! UserId = ' . $userId);
        }
    }
}