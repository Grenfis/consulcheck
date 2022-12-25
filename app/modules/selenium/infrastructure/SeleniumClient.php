<?php

namespace app\modules\selenium\infrastructure;

use app\modules\selenium\dto\Handler;
use app\modules\selenium\ISeleniumClient;
use Campo\UserAgent;
use Facebook\WebDriver\Chrome\ChromeDevToolsDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\Exception\UnknownErrorException;
use Facebook\WebDriver\Exception\UnsupportedOperationException;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

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

        $sessionIdFilePath = '/tmp/selenium_session_id.txt';
        if (file_exists($sessionIdFilePath)) {
            $sessionId = file_get_contents($sessionIdFilePath);
            if ($sessionId) {
                $this->driver = RemoteWebDriver::createBySessionID($sessionId, $url);
                return;
            }
        }

        $options = new ChromeOptions();
        $options->addArguments([
            '--no-sandbox',
            '--disable-blink-features',
            '--disable-blink-features=AutomationControlled',
            '--disable-plugins-discovery',
            '--disable-extensions',
            '--headless',
            'window-size=1920,1080'
        ]);

        $capabilities = new DesiredCapabilities();
        $capabilities->setCapability(ChromeOptions::CAPABILITY_W3C, $options);

        $this->driver = RemoteWebDriver::create($url, $capabilities);
        file_put_contents($sessionIdFilePath, $this->driver->getSessionID());
    }

    /**
     * @throws UnsupportedOperationException
     * @throws \Exception
     */
    public function openTab(string $url): Handler
    {
        $handlersFile = '/tmp/selenium_handlers.txt';
        $fileContent = '{}';
        if (file_exists($handlersFile)) {
            $fileContent = file_get_contents($handlersFile);
        }
        $handles = json_decode($fileContent, true);

        $handle = $handles[$url] ?? null;

        if (!$handle) {
            return $this->getTabHandle($url, $handles, $handlersFile);
        }

        try {
            $this->driver->switchTo()->window($handle);
            return new Handler(
                $handle
            );
        } catch (\Exception $e) {
            return $this->getTabHandle($url, $handles, $handlersFile);
        }
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function waitPresence(string $selector)
    {
        $this->driver->wait(10, 1000)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector($selector))
        );
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function waitVisibility(string $selector)
    {
        $this->driver->wait(10, 1000)->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector($selector))
        );
    }

    /**
     * @throws UnknownErrorException
     */
    public function click(string $selector)
    {
        $this->driver->findElement(WebDriverBy::cssSelector($selector))
            ->click();
    }

    /**
     * @throws UnknownErrorException
     */
    public function takeElementScreenshot(string $selector, string $filePath)
    {
        $this->driver->findElement(WebDriverBy::cssSelector($selector))
            ->takeElementScreenshot($filePath);
    }

    /**
     * @throws UnknownErrorException
     */
    public function switchToFrame(string $selector, ?Handler $handle = null)
    {
        $driver = $handle ? $this->driver->switchTo()->window($handle->value) : $this->driver;
        $iframe = $driver->findElement(WebDriverBy::cssSelector($selector));
        $driver->switchTo()->frame($iframe);
    }

    public function switchToWindow(Handler $handle)
    {
        $this->driver->switchTo()->window($handle->value);
    }

    /**
     * @throws UnknownErrorException
     * @throws UnsupportedOperationException
     */
    public function getHtml(string $selector): string
    {
        return $this->driver->findElement(WebDriverBy::cssSelector($selector))->getDomProperty('innerHTML');
    }

    /**
     * @throws UnknownErrorException
     * @throws UnsupportedOperationException
     */
    public function getText(string $selector): string
    {
        return $this->driver->findElement(WebDriverBy::cssSelector($selector))->getDomProperty('innerText');
    }

    /**
     * @throws UnknownErrorException
     */
    public function enterText(string $selector, string $text)
    {
        $element = $this->driver->findElement(WebDriverBy::cssSelector($selector));
        $element->clear();
        $element->sendKeys($text);
    }

    public function reload()
    {
        $this->driver->navigate()->refresh();
    }

    /**
     * @throws UnsupportedOperationException
     * @throws \Exception
     */
    private function getTabHandle(string $url, array $handles, string $file): Handler
    {
        $existsHandlers = $this->driver->getWindowHandles();
        if (count($existsHandlers) > 0) {
            $this->driver->switchTo()->window($existsHandlers[0]);
        }
        $window = $this->driver->switchTo()->newWindow();
        $this->get($url);

        $handle = $window->getWindowHandle();
        $handles[$url] = $handle;

        $json = json_encode($handles);
        file_put_contents($file, $json);

        return new Handler(
            $handle
        );
    }

    /**
     * @throws \Exception
     */
    private function get(string $url)
    {
        $driver = $this->driver;
        $devTools = new ChromeDevToolsDriver($driver);

        $userAgent = UserAgent::random();
        $devTools->execute(
            'Network.setUserAgentOverride',
            ['userAgent' => $userAgent]
        );

        $driver->get($url);
    }
}