<?php

namespace app\modules\users;

interface IGateway
{
    public function setAdminStatus(int $userId, bool $status);

    public function addUserToQueue(int $userId, int $queueId);
}