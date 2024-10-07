<?php
declare(strict_types=1);

namespace SergeR\WebasystAccountSDK\Api;

use Http\Client\Exception;
use SergeR\WebasystAccountSDK\Client;
use SergeR\WebasystAccountSDK\Message\ResponseMediator;

class AbstractApi
{
    /**
     * @param Client $client
     */
    public function __construct(protected readonly Client $client)
    {
    }

    /**
     * Performs an HTTP GET request to an API method
     *
     * @throws Exception
     */
    protected function _get(string $path, array $parameters = [], array $requestHeaders = []): string|array
    {
        if ($parameters) {
            $path .= '?' . http_build_query($parameters, '', '&', PHP_QUERY_RFC3986);
        }

        $response = $this->client->getHttpClient()->get($path, $requestHeaders);

        return ResponseMediator::getContent($response);
    }

    /**
     * @throws Exception
     */
    protected function _post(string $path, array $parameters = [], array $requestHeaders = []): string|array
    {
        $body = null;
        if ($parameters) {
            $requestHeaders['Content-Type'] = 'application/x-www-form-urlencoded';
            $body = http_build_query($parameters, '', '&', PHP_QUERY_RFC3986);
        }

        $response = $this->client->getHttpClient()->post($path, $requestHeaders, $body);

        return ResponseMediator::getContent($response);
    }

    /**
     * @throws Exception
     */
    protected function _delete(string $path, array $parameters = [], array $requestHeaders = []): string|array
    {
        if ($parameters) {
            $path .= '?' . http_build_query($parameters, '', '&', PHP_QUERY_RFC3986);
        }

        $response = $this->client->getHttpClient()->delete($path, $requestHeaders);

        return ResponseMediator::getContent($response);
    }
}
