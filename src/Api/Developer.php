<?php
declare(strict_types=1);

namespace SergeR\WebasystAccountSDK\Api;

use Http\Client\Exception;
use InvalidArgumentException;
use SergeR\WebasystAccountSDK\Api\Developer\License;
use SergeR\WebasystAccountSDK\Api\Developer\Promocode;

final class Developer extends AbstractApi
{
    /**
     * @return array
     * @throws Exception
     */
    public function balance(): array
    {
        return $this->_get('/developer/balance/');
    }

    /**
     * @throws Exception
     */
    public function transactions(int $count = null, int $offset = null): array
    {
        $parameters = [];
        if (isset($count)) {
            $parameters['last'] = $count;
        }
        if (isset($offset)) {
            $parameters['offset'] = $offset;
        }

        return $this->_get('/developer/ca/', $parameters);
    }

    public function license(): License
    {
        return new License($this->client);
    }

    /**
     * @throws Exception
     */
    public function licenses(string $domain = null, string $installer_id = null): array
    {
        return $this->license()->all($domain, $installer_id);
    }

    /**
     * @throws Exception
     */
    public function order(int $order_id): array
    {
        return $this->_get('/developer/order/', ['order_id' => $order_id]);
    }

    public function promocode(): Promocode
    {
        return new Promocode($this->client);
    }

    /**
     * @throws Exception
     */
    public function promocodes(): array
    {
        return $this->promocode()->all();
    }

    /**
     * @throws Exception
     */
    public function products(): array
    {
        return $this->_get('/products/');
    }
}
