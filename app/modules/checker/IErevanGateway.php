<?php

namespace app\modules\checker;

interface IErevanGateway
{
    public function reloadTab();
    public function openTab(string $url);

    public function findGeneralCaptcha(): ?string;

    public function enterGeneralCaptcha(string $text);

    public function makeAnAppointment();

    public function checkAnchor(): ?string;
}