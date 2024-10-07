<?php
declare(strict_types=1);

namespace SergeR\WebasystAccountSDK\Api\Developer;

use Http\Client\Exception;
use SergeR\WebasystAccountSDK\Api\AbstractApi;
use SergeR\WebasystAccountSDK\Contracts\Developer\PromocodeInterface;

final class Promocode extends AbstractApi
{
    private const PROMOCODE_ENDPOINT = '/developer/promocode/';

    /**
     * @throws Exception
     */
    public function all(): array
    {
        return $this->_get(self::PROMOCODE_ENDPOINT);
    }

    /**
     * @throws Exception
     */
    public function get(string $code): array
    {
        $parameters = [];
        $parameters['code'] = $code;

        return $this->_get(self::PROMOCODE_ENDPOINT, $parameters);
    }

    /**
     * @throws Exception
     */
    public function create(PromocodeInterface $promocode): array|string
    {
        $parameters = [
            'code'        => $promocode->getCode(),
            'percent'     => $promocode->getPercent(),
            'products'    => $promocode->getProducts(),
            'description' => $promocode->getDescription()
        ];
        if ($type = $promocode->getType()) {
            $parameters['type'] = $type;
        }
        if ($date = $promocode->getStartDate()) {
            $parameters['start_date'] = $date->format('Y-m-d');
        }
        if ($date = $promocode->getEndDate()) {
            $parameters['end_date'] = $date->format('Y-m-d');
        }

        return $this->_post(self::PROMOCODE_ENDPOINT, $parameters);
    }

    /**
     * @throws Exception
     */
    public function delete(string $code): array
    {
        return $this->_delete(self::PROMOCODE_ENDPOINT, ['code' => $code]);
    }
}
