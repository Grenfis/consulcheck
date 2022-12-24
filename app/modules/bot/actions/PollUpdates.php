<?php

namespace app\modules\bot\actions;

use app\modules\bot\events\DDGSolutionWasReceived;
use app\modules\bot\events\GeneralSolutionWasReceived;
use app\modules\bot\events\NewAdminUsersAppears;
use app\modules\bot\events\UsersWantsToQueue;
use app\modules\bot\ITelegramGateway;
use app\modules\common\IEventDispatcher;
use app\modules\common\ILogger;

class PollUpdates
{
    private ITelegramGateway $gateway;
    private ILogger $logger;
    private IEventDispatcher $dispatcher;

    public function __construct(ITelegramGateway $gateway, ILogger $logger, IEventDispatcher $dispatcher)
    {
        $this->gateway = $gateway;
        $this->logger = $logger;
        $this->dispatcher = $dispatcher;
    }

    public function poll()
    {
        $result = $this->gateway->getUpdates();
        if (!$result->isOk) {
            $this->logger->warning('Telegram error: ' . $result->description);
        }

        if (count($result->newAdmins) > 0) {
            $this->dispatcher->emit(new NewAdminUsersAppears($result->newAdmins));
        }

        if (count($result->usersToQueue) > 0) {
            $this->dispatcher->emit(new UsersWantsToQueue($result->usersToQueue));
        }

        if (count($result->solveDDG) > 0) {
            $this->dispatcher->emit(new DDGSolutionWasReceived($result->solveDDG));
        }

        if (count($result->solveGeneral) > 0) {
            $this->dispatcher->emit(new GeneralSolutionWasReceived($result->solveGeneral));
        }
    }
}