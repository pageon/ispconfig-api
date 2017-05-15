<?php

namespace Pageon\IspconfigApi\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\Psr7\Response;

final class Client
{
    /** @var SetCookie|null */
    private $sessionCookie;

    /** @var string */
    private $endpoint;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var GuzzleClient */
    private $guzzleClient;

    /** @var bool */
    private $isLoggedIn = false;

    public function __construct(GuzzleClient $guzzleClient, string $endpoint, string $username, string $password)
    {
        $this->endpoint = trim($endpoint, " \t\n\r\0\x0B/");
        $this->username = $username;
        $this->password = $password;

        $this->guzzleClient = $guzzleClient;
    }

    public function login(): void
    {
        // already logged in
        if ($this->isLoggedIn) {
            return;
        }

        // make sure we have a session cookie
        $this->call('GET', 'login');

        $this->call(
            'POST',
            '/login/index.php',
            [
                'form_params' => [
                    'username' => $this->username,
                    'password' => $this->password,
                    's_mod' => "login",
                    's_pg' => "index",
                ],
            ]
        );
    }

    public function logout(): void
    {
        $this->call('GET', 'login/logout.php');
    }

    public function isLoggedIn(): bool
    {
        return $this->isLoggedIn;
    }

    private function hasSessionCookie(): bool
    {
        return $this->sessionCookie instanceof SetCookie;
    }

    private function updateSessionCookieFromResponse(Response $response): void
    {
        $this->sessionCookie = SetCookie::fromString($response->getHeaderLine('Set-Cookie'));
    }

    private function call(string $method, string $endpoint = 'index.php', array $options = []): Response
    {
        $response = $this->guzzleClient->request(
            $method,
            $this->endpoint . '/' . trim($endpoint, '/'),
            $this->buildCallOptions($options)
        );

        $this->updateSessionCookieFromResponse($response);

        // check if we are logged in
        $this->isLoggedIn = strpos($response->getBody()->getContents(), 'login/logout.php') !== false;

        return $response;
    }

    private function buildCallOptions(array $options): array
    {
        if (!$this->hasSessionCookie()) {
            return $options;
        }

        if (!array_key_exists('cookies', $options)) {
            $options['cookies'] = new CookieJar();
        }

        $options['cookies']->setCookie($this->sessionCookie);

        return $options;
    }
}
