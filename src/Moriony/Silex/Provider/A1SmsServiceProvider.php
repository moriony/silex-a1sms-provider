<?php
namespace Moriony\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use \Moriony\Service\A1Sms\Client as A1SmsClient;

class A1SmsServiceProvider implements ServiceProviderInterface
{
    const A1SMS = 'a1sms';
    const A1SMS_OPTIONS = 'a1sms.options';

    const OPT_LOGIN = 'login';
    const OPT_PASSWORD = 'password';
    const OPT_SENDER = 'sender';

    protected static $defaultOptions = array(
        self::OPT_LOGIN => null,
        self::OPT_PASSWORD => null,
        self::OPT_SENDER => null,
    );

    /**
     * @param Application $app An Application instance
     */
    public function register(Application $app)
    {
        $app[self::A1SMS] = $app->share(function () use($app) {
            $options = $app[A1SmsServiceProvider::A1SMS_OPTIONS];
            return new A1SmsClient($options[A1SmsServiceProvider::OPT_LOGIN],
                                   $options[A1SmsServiceProvider::OPT_PASSWORD],
                                   $options[A1SmsServiceProvider::OPT_SENDER]);
        });
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
        $app[self::A1SMS_OPTIONS] = array_merge(self::$defaultOptions, $app[self::A1SMS_OPTIONS]);
    }
}
