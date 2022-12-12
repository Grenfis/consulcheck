<?php

namespace app\modules\users;

interface IGateway
{
    public function setAdminStatus(int $userId, bool $status);
}