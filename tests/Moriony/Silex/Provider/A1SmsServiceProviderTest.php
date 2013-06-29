<?php
namespace Moriony\Silex\Provider;

use Silex\Application;
use Moriony\Silex\Provider\A1SmsServiceProvider;

class A1SmsServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Application
     */
    protected $app;

    public function setUp()
    {
        $this->app = new Application();
        $this->app->register(new A1SmsServiceProvider, array(
            A1SmsServiceProvider::A1SMS_OPTIONS => array(
                A1SmsServiceProvider::OPT_LOGIN => 'login',
                A1SmsServiceProvider::OPT_PASSWORD => 'password',
                A1SmsServiceProvider::OPT_SENDER => 'sender',
            )
        ));
        $this->app->boot();
    }

    public function testClientObtain()
    {
        $this->assertInstanceOf('\Moriony\Service\A1Sms\Client', $this->app[A1SmsServiceProvider::A1SMS]);
    }

    public function testLoginObtain()
    {
        $this->assertEquals('login', $this->app[A1SmsServiceProvider::A1SMS]->getLogin());
    }

    public function testPasswordObtain()
    {
        $this->assertEquals('password', $this->app[A1SmsServiceProvider::A1SMS]->getPassword());
    }

    public function testSenderObtain()
    {
        $this->assertEquals('sender', $this->app[A1SmsServiceProvider::A1SMS]->getSender());
    }
}