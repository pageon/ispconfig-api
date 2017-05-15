<?php

namespace Pageon\IspconfigApi\Tests\functional\Account;

use Pageon\IspconfigApi\Tests\TestCase;

class AccountTest extends TestCase
{
    public function testLogin(): void
    {
        $account = self::getAccount();

        $this->assertFalse($account->isLoggedIn());
        $account->login();
        $this->assertTrue($account->isLoggedIn());
    }

    public function testLogout(): void
    {
        $account = self::getAccount();

        $account->login();
        $this->assertTrue($account->isLoggedIn());
        $account->logout();
        $this->assertFalse($account->isLoggedIn());

    }
}
