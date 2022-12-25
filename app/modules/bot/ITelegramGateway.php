<?php

namespace app\modules\bot;

use app\modules\bot\dto\TelegramGetUpdatesDto;

interface ITelegramGateway
{
    public function getUpdates(): TelegramGetUpdatesDto;

    public function sendDDGMessageToAdmins(string $captchaPath);

    public function sendGyumri5CaptchaMessageToAdmin(string $captchaPath);

    public function sendGyumri10CaptchaMessageToAdmin(string $captchaPath);

    public function sendErevanCaptchaMessageToAdmin(string $captchaPath);

    public function sendDocumentToUsers(string $caption, string $path, int ...$users);
}