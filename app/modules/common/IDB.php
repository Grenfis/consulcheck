<?php

namespace app\modules\common;

interface IDB
{
    public function prepare(string $query);

    public function execute(?array $args = null);

    public function result(): array;

    /**
     * @return array[]
     */
    public function results(): array;
}