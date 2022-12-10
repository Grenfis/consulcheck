<?php

namespace app\modules\common\infrastructure;

use app\modules\common\ISeleniumGateway;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

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