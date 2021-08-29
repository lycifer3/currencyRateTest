<?php

namespace App\Service\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

class CoinDescClient implements CurrencyClientInterface
{
    private HttpClientInterface $client;
    private string $url;

    public function __construct(HttpClientInterface $client, string $url)
    {
        $this->client = $client;
        $this->url = $url;
    }

    /**
     * {@inheritDoc}
     * @throws Throwable
     */
    public function getBitcoinRates(): array
    {
        $response = $this->client->request('GET', $this->url);

        return $response->toArray();
    }
}