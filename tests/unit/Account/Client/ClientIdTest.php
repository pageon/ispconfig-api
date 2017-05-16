<?php

namespace Pageon\IspconfigApi\Tests\unit\Account\Client;

use Pageon\IspconfigApi\Account\Client\ClientId;
use Pageon\IspconfigApi\Tests\TestCase;
use TypeError;

class ClientIdTest extends TestCase
{
    /**
     * @expectedException TypeError
     */
    public function testOnlyAcceptsInteger(): void
    {
        new ClientId('pageon');
    }

    public function testGettingTheIntegerValue(): void
    {
        $this->assertSame(1, (new ClientId(1))->asInt());
    }

    public function testToString(): void
    {
        $this->assertSame('1', (string) new ClientId(1));
    }
}
