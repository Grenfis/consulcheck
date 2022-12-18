<?php

namespace app\modules\selenium\infractructure;

use app\modules\selenium\ISeleniumClient;
use Facebook\WebDriver\Exception\UnsupportedOperationException;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class SeleniumClient implements ISeleniumClient
{
    private RemoteWebDriver $driver;

    public function __construct()
    {
        $this->initDriver();
    }

    private function initDriver()
    {
        $url = SELENIUM_SERVER . ':' . SELENIUM_PORT . '/wd/hub';
        $timeout = 3000;

        $sessionIdFilePath = '/tmp/selenium_session_id.txt';
        if (file_exists($sessionIdFilePath)) {
            $sessionId = file_get_contents($sessionIdFilePath);
            if ($sessionId) {
                $this->driver = RemoteWebDriver::createBySessionID($sessionId, $url, $timeout);
                return;
            }
        }
        $this->driver = RemoteWebDriver::create($url, DesiredCapabilities::chrome(), $timeout);
        file_put_contents($sessionIdFilePath, $this->driver->getSessionID());
    }

    /**
     * @throws UnsupportedOperationException
     */
    public function openTab(string $url): string
    {
        $handle = $this->getTabHandle($url);

        if (!$handle) {
            $window = $this->driver->switchTo()->newWindow();
            $window->get($url);
            return $window->getWindowHandle();
        }

        return $handle;
    }

    private function getTabHandle(string $url): ?string
    {
        $handles = $this->driver->getWindowHandles() ?: [];
        foreach($handles as $handle) {
            $window = $this->driver->switchTo()->window($handle);
            if (strpos($window->getCurrentURL(), $url) !== false) {
                return $handle;
            }
        }

        return null;
    }
}