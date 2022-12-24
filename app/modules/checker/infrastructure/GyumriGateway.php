<?php

namespace app\modules\checker\infrastructure;

use app\modules\checker\IGyumriGateway;
use app\modules\selenium\dto\Handler;
use app\modules\selenium\ISeleniumClient;

class GyumriGateway implements IGyumriGateway
{
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
    public function findDDOSCaptcha(): string
    {
        try {
            $this->client->waitPresence('#ddg-iframe');

            $this->client->switchToFrame('#ddg-iframe', $this->tabHandler);
            $this->client->waitPresence('#ddg-captcha');
            $this->client->click('#ddg-captcha');

            $this->client->waitVisibility('#ddg-challenge');

            $path = CAPTCHAS_DIR . DIRECTORY_SEPARATOR . 'gyumri_' . (new \DateTime())->format('Ymd_His') . '.png';
            $this->client->takeElementScreenshot(
                '.ddg-modal__captcha-image',
                $path
            );
            return $path;
        } catch (\Exception $e) {
            $this->client->switchToWindow($this->tabHandler);
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
}