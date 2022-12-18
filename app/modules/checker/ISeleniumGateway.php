<?php

namespace app\modules\checker;

interface ISeleniumGateway
{
    public function openTab(string $url): string;
}