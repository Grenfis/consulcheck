<?php

namespace app\modules\selenium;

use app\modules\selenium\dto\Handler;

interface ISeleniumClient
{
    public function openTab(string $url): Handler;

    public function switchToWindow(Handler $handle);

    public function switchToFrame(string $selector, ?Handler $handle = null);

    public function waitPresence(string $selector);

    public function waitVisibility(string $selector);

    public function click(string $selector);

    public function takeElementScreenshot(string $selector, string $filePath);

    public function getHtml(string $selector): string;

    public function getText(string $selector): string;

    public function enterText(string $selector, string $text);

    public function reload();
}