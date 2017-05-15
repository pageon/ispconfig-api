<?php

namespace Pageon\IspconfigApi\Api;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\Psr7\Response;

final class Api
{
    /** @var SetCookie|null */
    private $sessionCookie;

    /** @var string */
    private $endpoint;

    /** @var bool */
    private $isAuthenticated = false;

    public function __construct(GuzzleClient $guzzleClient, string $endpoint)
    {
        $this->endpoint = trim($endpoint, " \t\n\r\0\x0B/");
        $this->guzzleClient = $guzzleClient;
    }

    public function call(string $method, string $endpoint = 'index.php', array $options = []): Response
    {
        $response = $this->guzzleClient->request(
            $method,
            $this->endpoint . '/' . trim($endpoint, '/'),
            $this->buildCallOptions($options)
        );

        $this->updateSessionCookieFromResponse($response);

        // check if we are logged in
        $this->isAuthenticated = strpos($response->getBody()->getContents(), 'login/logout.php') !== false;

        return $response;
    }

    public function isAuthenticated(): bool
    {
        return $this->isAuthenticated;
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

    private function hasSessionCookie(): bool
    {
        return $this->sessionCookie instanceof SetCookie;
    }

    private function updateSessionCookieFromResponse(Response $response): void
    {
        $this->sessionCookie = SetCookie::fromString($response->getHeaderLine('Set-Cookie'));
    }
}
