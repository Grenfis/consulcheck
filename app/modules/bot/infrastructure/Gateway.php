<?php

namespace app\modules\bot\infrastructure;

use app\modules\common\IDB;
use app\modules\bot\IGateway;

class Gateway implements IGateway
{
    private IDB $db;

    public function __construct(IDB $db)
    {
        $this->db = $db;
    }

    /**
     * @return int[]
     */
    public function getAdminIds(): array
    {
        $query = "
            SELECT user_id FROM users WHERE user_is_admin = true AND user_is_active = true;
        ";
        $this->db->prepare($query);
        $this->db->execute();
        $data = $this->db->results();
        return array_map(static fn(array $row) => $row['user_id'], $data ?: []);
    }
}