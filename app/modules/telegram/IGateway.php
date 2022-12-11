<?php

namespace app\modules\telegram;

interface IGateway
{
    /**
     * @return int[]
     */
    public function getAdminIds(): array;
}