<?php

namespace app\modules\checker\infrastructure;

use app\modules\checker\ISeleniumGateway;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class SeleniumGateway implements ISeleniumGateway
{
    private RemoteWebDriver $driver;

    public function __construct()
    {
        $this->driver = RemoteWebDriver::create(
            SELENIUM_SERVER . ':' . SELENIUM_PORT . '/wd/hub',
            DesiredCapabilities::chrome(),
            3000
        );
    }

    public function __destruct()
    {
        $this->driver->quit();
    }
}