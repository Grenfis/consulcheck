<?php

namespace app\modules\bot;

interface IGateway
{
    /**
     * @return int[]
     */
    public function getAdminIds(): array;
}