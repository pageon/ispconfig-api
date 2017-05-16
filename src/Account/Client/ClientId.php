<?php


namespace Pageon\IspconfigApi\Account\Client;

final class ClientId
{
    /** @var int */
    private $clientId;

    public function __construct(int $clientId)
    {
        $this->clientId = $clientId;
    }

    public function asInt(): int
    {
        return $this->clientId;
    }

    public function __toString(): string
    {
        return (string) $this->clientId;
    }
}
