<?php

namespace Pageon\IspconfigApi\Tests;

use GuzzleHttp\Client as GuzzleClient;
use Pageon\IspconfigApi\Account\Account;
use Pageon\IspconfigApi\Api\Api;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var Account */
    private static $account;

    protected static function getAccount(): Account
    {
        if (self::$account instanceof Account) {
            return self::$account;
        }

        self::$account = new Account(
            new Api(new GuzzleClient(), getenv('PAGEON_ISPCONFIG_TEST_ENDPOINT')),
            getenv('PAGEON_ISPCONFIG_TEST_USERNAME'),
            getenv('PAGEON_ISPCONFIG_TEST_PASSWORD')
        );

        return self::$account;
    }

    public function assertPreConditions(): void
    {
        $this->assertNotEmpty(
            getenv('PAGEON_ISPCONFIG_TEST_ENDPOINT'),
            'The environment variable PAGEON_ISPCONFIG_TEST_ENDPOINT needs to contain the endpoint'
        );
        $this->assertNotEmpty(
            getenv('PAGEON_ISPCONFIG_TEST_USERNAME'),
            'The environment variable PAGEON_ISPCONFIG_TEST_USERNAME needs to contain the username to test with'
        );
        $this->assertNotEmpty(
            getenv('PAGEON_ISPCONFIG_TEST_PASSWORD'),
            'The environment variable PAGEON_ISPCONFIG_TEST_PASSWORD needs to contain the password to test with'
        );
    }
}
