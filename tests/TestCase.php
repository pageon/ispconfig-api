<?php

namespace Pageon\IspconfigApi\Tests;

class TestCase extends \PHPUnit\Framework\TestCase
{
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
