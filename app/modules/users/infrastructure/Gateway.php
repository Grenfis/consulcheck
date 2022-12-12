<?php

namespace app\modules\users\infrastructure;

use app\modules\common\IDB;
use app\modules\users\IGateway;

class Gateway implements IGateway
{
    private IDB $db;

    public function __construct(IDB $db)
    {
        $this->db = $db;
    }

    public function setAdminStatus(int $userId, bool $status)
    {
        $query = "
            UPDATE users SET user_is_admin = :status WHERE user_id = :user_id;
        ";

        $this->db->prepare($query);
        $this->db->execute([
            ':status' => $status,
            ':user_id' => $userId,
        ]);
    }
}