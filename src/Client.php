<?php
declare(strict_types=1);

namespace SergeR\WebasystAccountSDK;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\Authentication\Header as HeaderKeyAuthetication;
use Psr\Http\Message\UriFactoryInterface;
use SergeR\WebasystAccountSDK\Api\Developer;

final class Client
{
    private const API_KEY_HEADER = 'X-Api-Key';

    private const BASE_URL = 'https://www.webasyst.ru/my/api';

    private ClientBuilder $clientBuilder;

    public function __construct(ClientBuilder $clientBuilder = null, UriFactoryInterface $uriFactory = null)
    {
        $uriFactory = $uriFactory ?: Psr17FactoryDiscovery::findUriFactory();
        $this->clientBuilder = $clientBuilder ?: new ClientBuilder();
        $this->clientBuilder->addPlugin(new BaseUriPlugin($uriFactory->createUri(self::BASE_URL)));
        $this->clientBuilder->addPlugin(new HeaderDefaultsPlugin([
            'User-Agent' => 'Syrnik Webasyst Account SDK',
            'Accept'     => 'application/json'
        ]));
    }

    public function authenticate(string $apiKey): void
    {
        $this->clientBuilder->removePlugin(AuthenticationPlugin::class);
        $this->clientBuilder->addPlugin(new AuthenticationPlugin(new HeaderKeyAuthetication(self::API_KEY_HEADER, $apiKey)));
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->clientBuilder->getHttpClient();
    }

    public function developer(): Developer
    {
        return new Developer($this);
    }
}
