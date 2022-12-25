<?php

namespace app\modules\checker\infrastructure;

use app\modules\checker\IGyumriGateway;
use app\modules\selenium\dto\Handler;
use app\modules\selenium\ISeleniumClient;

class GyumriGateway implements IGyumriGateway
{
    private const ANCHOR = 'В настоящий момент на интересующее Вас консульское действие в системе предварительной записи нет свободного времени.';

    private ISeleniumClient $client;
    private ?Handler $tabHandler;

    public function __construct(ISeleniumClient $client)
    {
        $this->client = $client;
        $this->tabHandler = null;
    }

    public function openTab(string $url)
    {
        $this->tabHandler = $this->client->openTab($url);
    }

    /**
     * @throws \RuntimeException
     */
    public function findDDOSCaptcha(): ?string
    {
        try {
            $this->client->switchToWindow($this->tabHandler);
            $this->client->waitPresence('#ddg-iframe');

            $this->client->switchToFrame('#ddg-iframe', $this->tabHandler);
            try {
                $this->client->waitPresence('#ddg-captcha');
                $this->client->click('#ddg-captcha');
            } catch (\Exception $e) {
                // пропускаем этот блок
            }

            $this->client->waitVisibility('#ddg-challenge');

            $path = CAPTCHAS_DIR . DIRECTORY_SEPARATOR . 'ddg_' . (new \DateTime())->format('Ymd_His') . '.png';
            $this->client->takeElementScreenshot(
                '.ddg-modal__captcha-image',
                $path
            );
            return $path;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function enterDDOSCaptcha(string $text)
    {
        // даже если введем каптчу неверно - при следующей проверке получим новую
        $this->client->switchToWindow($this->tabHandler);
        $this->client->switchToFrame('#ddg-iframe', $this->tabHandler);
        $this->client->enterText('.ddg-modal__input', $text);
        $this->client->click('.ddg-modal__submit');
    }

    public function findGeneralCaptcha(): ?string
    {
        try {
            $this->client->switchToWindow($this->tabHandler);

            $this->client->waitPresence('#ctl00_MainContent_imgSecNum');
            $path = CAPTCHAS_DIR . DIRECTORY_SEPARATOR . 'gyumri_' . (new \DateTime())->format('Ymd_His') . '.png';
            $this->client->takeElementScreenshot('#ctl00_MainContent_imgSecNum', $path);

            return $path;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function enterGeneralCaptcha(string $text)
    {
        $this->client->switchToWindow($this->tabHandler);
        $this->client->enterText('#ctl00_MainContent_txtCode', $text);
        $this->client->click('#ctl00_MainContent_ButtonA');
    }

    public function makeAnAppointment()
    {
        $this->client->switchToWindow($this->tabHandler);
        try {
            $this->client->waitPresence('#ctl00_MainContent_ButtonB');
            $this->client->click('#ctl00_MainContent_ButtonB');
        } catch (\Exception $e) {

        }
    }

    public function checkAnchor(): ?string
    {
        $this->client->switchToWindow($this->tabHandler);
        try {
            $this->client->waitVisibility('#center-panel');
            $anchorText = $this->client->getText('#center-panel > p');
            if ($anchorText !== self::ANCHOR) {
                $path = AVAILABLE_PLACES_DIR . DIRECTORY_SEPARATOR . 'gyumri_' . (new \DateTime())->format('Ymd_His') . '.png';
                $this->client->takeElementScreenshot('body', $path);
                return $path;
            }
        } catch (\Exception $exception) {
        }

        return null;
    }

    public function reloadTab()
    {
        $this->client->switchToWindow($this->tabHandler);
        $this->client->reload();
    }
}