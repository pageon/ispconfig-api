<?php

namespace Pageon\IspconfigApi\Account;

use Pageon\IspconfigApi\Api\Api;

final class Account
{
    /** @var Api */
    private $api;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    public function __construct(Api $api, string $username, string $password)
    {
        $this->api = $api;
        $this->username = $username;
        $this->password = $password;
    }

    public function login(): void
    {
        // already logged in
        if ($this->isLoggedIn()) {
            return;
        }

        // make sure we have a session cookie
        $this->api->call('GET', 'login');

        $this->api->call(
            'POST',
            'login/index.php',
            [
                'form_params' => [
                    'username' => $this->username,
                    'password' => $this->password,
                    's_mod' => 'login',
                    's_pg' => 'index',
                ],
            ]
        );
    }

    public function logout(): void
    {
        $this->api->call('GET', 'login/logout.php');
    }

    public function isLoggedIn(): bool
    {
        return $this->api->isAuthenticated();
    }
}
