<?php

namespace Http\Adapters\Guzzle6;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Http\Client\HttpAsyncClient;
use Http\Client\HttpClient;
use Http\Tools\HttpClientEmulator;
use Psr\Http\Message\RequestInterface;

/**
 * HTTP Adapter for Guzzle 6.
 *
 * @author David de Boer <david@ddeboer.nl>
 */
class Guzzle6HttpAdapter implements HttpClient, HttpAsyncClient
{
    use HttpClientEmulator;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param ClientInterface|null $client
     */
    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client ?: new Client();
    }

    /**
     * {@inheritdoc}
     */
    public function sendAsyncRequest(RequestInterface $request)
    {
        $promise = $this->client->sendAsync($request);

        return new Guzzle6Promise($promise, $request);
    }
}
