<?php


namespace Pageon\IspconfigApi\Common;

use InvalidArgumentException;

final class EmailAddress
{
    /** @var string */
    private $address;

    public function __construct($address)
    {
        if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('"%s" is not a valid email', $address));
        }

        $this->address = $address;
    }

    public function asString(): string
    {
        return $this->address;
    }

    public function __toString(): string
    {
        return $this->address;
    }

    public function equals(EmailAddress $address): bool
    {
        return strtolower((string) $this) === strtolower((string) $address);
    }
}
