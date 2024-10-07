<?php
declare(strict_types=1);

namespace SergeR\WebasystAccountSDK\Api\Developer;

use Http\Client\Exception;
use InvalidArgumentException;
use SergeR\WebasystAccountSDK\Api\AbstractApi;
use SergeR\WebasystAccountSDK\Exceptions\HttpException;

final class License extends AbstractApi
{
    private const LICENSE_CHECK_ENDPOINT = '/developer/check/';

    /**
     * @throws Exception
     * @throws HttpException
     */
    public function all(string $domain = null, $installer_id = null): array
    {
        $parameters = $this->domainOrIdParam($domain, $installer_id);
        return $this->_get(self::LICENSE_CHECK_ENDPOINT, $parameters);
    }

    /**
     * @throws Exception
     * @throws HttpException
     */
    public function get(string $product, string $domain = null, $installer_id = null): array
    {
        $parameters = $this->domainOrIdParam($domain, $installer_id);
        $parameters['product'] = $product;
        return $this->_get(self::LICENSE_CHECK_ENDPOINT, $parameters);
    }

    private function domainOrIdParam(string $domain = null, string $installer_id = null): array
    {
        if ($domain) {
            return ['domain' => $domain];
        } elseif ($installer_id) {
            return ['static_id' => $installer_id];
        }

        throw new InvalidArgumentException('Domain or Webasyst Installer ID required');
    }
}