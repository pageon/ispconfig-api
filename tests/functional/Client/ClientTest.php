<?php

namespace Pageon\IspconfigApi\Tests\functional\Client;

use Pageon\IspconfigApi\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testLogin(): void
    {
        $client = self::getClient();

        $this->assertFalse($client->isLoggedIn());
        $client->login();
        $this->assertTrue($client->isLoggedIn());
    }

    public function testLogout(): void
    {
        $client = self::getClient();

        $client->login();
        $this->assertTrue($client->isLoggedIn());
        $client->logout();
        $this->assertFalse($client->isLoggedIn());

    }
}
