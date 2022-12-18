<?php

namespace app\modules\selenium;

interface ISeleniumClient
{
    public function openTab(string $url): string;
}