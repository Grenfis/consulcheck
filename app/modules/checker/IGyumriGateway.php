<?php

namespace app\modules\checker;

interface IGyumriGateway
{
    public function openTab(string $url);

    public function findDDOSCaptcha(): ?string;

    public function enterDDOSCaptcha(string $text);

    public function findGeneralCaptcha(): ?string;

    public function enterGeneralCaptcha(string $text);

    public function makeAnAppointment();

    public function checkAnchor(): ?string;
}