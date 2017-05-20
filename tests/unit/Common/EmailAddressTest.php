<?php

namespace Pageon\IspconfigApi\Tests\unit\Common;

use Pageon\IspconfigApi\Common\EmailAddress;
use Pageon\IspconfigApi\Tests\TestCase;

class EmailAddressTest extends TestCase
{
    public function testValidEmail(): void
    {
        $stringEmailAddress = 'test@pageon.be';
        $this->assertSame($stringEmailAddress, (string) new EmailAddress($stringEmailAddress));
    }

    public function testAsString(): void
    {
        $stringEmailAddress = 'test@pageon.be';
        $emailAddress = new EmailAddress($stringEmailAddress);

        $this->assertSame($stringEmailAddress, $emailAddress->asString());
    }

    public function testEquals(): void
    {
        $stringEmailAddress = 'test@pageon.be';
        $emailAddress = new EmailAddress($stringEmailAddress);

        $this->assertTrue($emailAddress->equals(new EmailAddress($stringEmailAddress)));
        $this->assertFalse($emailAddress->equals(new EmailAddress('other@pageon.be')));
    }
}
