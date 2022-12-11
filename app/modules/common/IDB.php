<?php

namespace app\modules\common;

interface IDB
{
    public function prepare(string $query);

    public function execute(array $args);

    public function result(): array;

    /**
     * @return array[]
     */
    public function results(): array;
}