<?php

namespace Pageon\IspconfigApi\Tests;

use Pageon\IspconfigApi\Client\Client;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var Client */
    private static $client;

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

    protected static function getClient(): Client
    {
        if (self::$client instanceof Client) {
            return self::$client;
        }

        self::$client = new Client(
            new \GuzzleHttp\Client(),
            getenv('PAGEON_ISPCONFIG_TEST_ENDPOINT'),
            getenv('PAGEON_ISPCONFIG_TEST_USERNAME'),
            getenv('PAGEON_ISPCONFIG_TEST_PASSWORD')
        );

        return self::$client;
    }
}
