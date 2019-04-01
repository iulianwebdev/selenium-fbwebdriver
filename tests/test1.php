<?php


// use PHPUnit\Extensions\Selenium2TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;
use PHPUnit\Framework\TestCase;


/**
 * Class to run 
 */
class RedCarsGoToGenevaTest extends TestCase
{
    public function setUp()
    {
        // $this->setHost('localhost');
        // $this->setPort(4444);
        // $this->setBrowserUrl('https://google.com');
        // $this->setBrowser('firefox');

        // $desired_capabilities = DesiredCapabilities::firefox()->setPlatform('LINUX')->setVersion('latest');
        $desired_capabilities = DesiredCapabilities::chrome()->setPlatform('LINUX')->setVersion('latest');
        $this->_session = RemoteWebDriver::create('http://localhost:4444/wd/hub',
            $desired_capabilities, 120000
        );
    }

    public function testIfItLoads()
    {
        $url = 'https://www.google.com/';
        $this->_session->get($url);
        $driver = $this->_session;
        $searchInputSelector = '.gLFyf.gsfi';
        $keyword = 'Red Cars';

        $location = function () use ($driver) {
            return $driver->executeScript('return window.location.href');
        };
        $this->assertEquals($location(), $url);

        $this->assertEquals('Google', $this->_session->getTitle());

        $driver->wait()->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector($searchInputSelector))
        );

        $el = $driver->findElement(WebDriverBy::cssSelector($searchInputSelector));
        $el->sendKeys($keyword);
        $driver->wait(500);
        $el->sendKeys(WebDriverKeys::ENTER);

        // $driver->sleep(200000000);
        
        $driver->wait()->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('div#hdtb-msb-vis > div:first-child + div > a'))
        );
        
        $driver->findElement(WebDriverBy::cssSelector('div#hdtb-msb-vis > div:first-child + div > a'))->click();
        
        $firstLinkSelector = '#rg_s > div:nth-child(2) > a.iKjWAf.irc-nic.isr-rtc';

        $driver->wait()->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector($firstLinkSelector))
        );

        $driver->findElement(WebDriverBy::cssSelector($firstLinkSelector))->click();

        // $driver->wait(10, 500)->until(WebDriverExpectedCondition::titleContains('Geneva'));
        echo $driver->getTitle();
        $driver->wait()->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::partialLinkText('Geneva'))
        );
        echo $driver->getTitle();

        $this->assertNotEquals($location(), $url);
    }

    public function tearDown()
    {
        // $this->stop();
        // $this->sendTestStatusToTestingBot();

        $this->_session->quit();

        unset($this->_session);
        parent::tearDown();
    }
}
