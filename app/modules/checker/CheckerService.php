<?php

namespace app\modules\checker;

use app\modules\checker\events\DDOSCaptchaWasFound;
use app\modules\checker\events\Gyumri10CaptchaWasFound;
use app\modules\checker\events\Gyumri10WasFindPlaces;
use app\modules\checker\events\Gyumri5CaptchaWasFound;
use app\modules\checker\events\Gyumri5WasFindPlaces;
use app\modules\common\EventsTrait;

class CheckerService
{
    use EventsTrait;

    private IErevanGateway $erevanGateway;
    private IGyumriGateway $gyumri5Gateway;
    private IGyumriGateway $gyumri10Gateway;

    public function __construct(
        IErevanGateway $erevanGateway,
        IGyumriGateway $gyumri5Gateway,
        IGyumriGateway $gyumri10Gateway
    )
    {
        $this->erevanGateway = $erevanGateway;
        $this->gyumri5Gateway = $gyumri5Gateway;
        $this->gyumri10Gateway = $gyumri10Gateway;
    }

    public function checkGyumri5(): bool
    {
        $this->gyumri5Gateway->openTab(GYUMRI_5_URL);

        $path = $this->gyumri5Gateway->findDDOSCaptcha();
        if ($path) {
            $this->emit(new DDOSCaptchaWasFound($path));
            return false;
        }

        $path = $this->gyumri5Gateway->findGeneralCaptcha();
        if ($path) {
            $this->emit(new Gyumri5CaptchaWasFound($path));
            return false;
        }

        $this->gyumri5Gateway->makeAnAppointment();

        $this->gyumri5Gateway->reloadTab();
        $checkResult = $this->gyumri5Gateway->checkAnchor();
        if ($checkResult) {
            $this->emit(new Gyumri5WasFindPlaces($checkResult));
        }

        return true;
    }

    public function checkGyumri10(): bool
    {
        $this->gyumri10Gateway->openTab(GYUMRI_10_URL);

        $path = $this->gyumri10Gateway->findGeneralCaptcha();
        if ($path) {
            $this->emit(new Gyumri10CaptchaWasFound($path));
            return false;
        }

        $this->gyumri10Gateway->makeAnAppointment();

        $this->gyumri10Gateway->reloadTab();
        $checkResult = $this->gyumri10Gateway->checkAnchor();
        if ($checkResult) {
            $this->emit(new Gyumri10WasFindPlaces($checkResult));
        }

        return true;
    }

    public function solveDDGCaptcha(string $text)
    {
        $this->gyumri5Gateway->openTab(GYUMRI_5_URL);
        $this->gyumri5Gateway->enterDDOSCaptcha($text);
    }
}