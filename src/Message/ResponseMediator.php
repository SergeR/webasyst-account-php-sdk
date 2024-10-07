<?php
declare(strict_types=1);

namespace SergeR\WebasystAccountSDK\Message;

use Psr\Http\Message\ResponseInterface;

final class ResponseMediator
{
    public static function getContent(ResponseInterface $response): array|string
    {
        $body = (string)$response->getBody();

        if (str_starts_with($response->getHeaderLine('Content-Type'), 'application/json')) {
            $content = json_decode($body, true);
            if (JSON_ERROR_NONE === json_last_error() && isset($content['data'])) {
                return $content['data'];
            }
        }

        return $body;
    }
}
