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

    public function addUserToQueue(int $userId, int $queueId)
    {
        $query = "
            INSERT INTO users_queue(user_id, queue_id, created_at)
            VALUES (:uid, :qid, :created_at);
        ";

        $this->db->prepare($query);
        $this->db->execute([
            ':uid' => $userId,
            ':qid' => $queueId,
            ':created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]);
    }
}