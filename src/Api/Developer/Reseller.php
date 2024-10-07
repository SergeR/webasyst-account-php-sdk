<?php
declare(strict_types=1);

namespace SergeR\WebasystAccountSDK\Api\Developer;

use Http\Client\Exception;
use SergeR\WebasystAccountSDK\Api\AbstractApi;

final class Reseller extends AbstractApi
{
    /**
     * @throws Exception
     */
    public function products(): array
    {
        return $this->_get('/developer/resellerstore/');
    }
}
