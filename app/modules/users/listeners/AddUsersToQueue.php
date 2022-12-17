<?php

namespace app\modules\users\listeners;

use app\modules\bot\events\UsersWantsToQueue;
use app\modules\common\ILogger;
use app\modules\users\IGateway;
use app\modules\users\IRepository;
use app\modules\users\UserService;

class AddUsersToQueue
{
    private IRepository $repository;
    private IGateway $gateway;
    private ILogger $logger;
    private UserService $service;

    public function __construct(IRepository $repository, IGateway $gateway, ILogger $logger, UserService $service)
    {
        $this->repository = $repository;
        $this->gateway = $gateway;
        $this->logger = $logger;
        $this->service = $service;
    }

    /**
     * @throws \RuntimeException
     */
    public function __invoke(UsersWantsToQueue $event)
    {
        foreach ($event->users() as $user) {
            $userId = $user['user_id'];
            $userName = $user['user_name'];
            $queue = $user['queue'];

            try {
                switch ($queue) {
                    case 'erevan_5':
                        $queueId = QUEUE_EREVAN_5;
                        break;

                    case 'gyumri_5':
                        $queueId = QUEUE_GYUMRI_5;
                        break;

                    case 'gyumri_10':
                        $queueId = QUEUE_GYUMRI_10;
                        break;

                    default:
                        throw new \RuntimeException("Не зарегистрирован такой обработчик события: userId = $userId, instance = " . get_class($event));
                }

                if (!$this->repository->exists($userId)) {
                    throw new \RuntimeException("Пользователя $userId не существует!");
                }

                if (!$this->repository->exists($userId)) {
                    $this->service->createUser($userId, $userName, false);
                }

                $this->gateway->addUserToQueue($userId, $queueId);

            } catch (\Exception $e) {
                $this->logger->warning($e->getMessage() . ' Stack: ' . $e->getTraceAsString());
            }
        }
    }
}