<?php

declare(strict_types=1);

namespace Salebot\Interfaces\Services;

use Salebot\Interfaces\Models\Response;

/**
 * Interface for salebot protocol
 * @package Salebot\Interfaces\Services
 */
interface ProtocolInterface
{
    /**
     * Send request to API
     *
     * @param string $httpMethod
     * @param string $apiMethod
     * @param array  $params
     *
     * @return Response
     */
    public function send(string $httpMethod, string $apiMethod, array $params = []): Response;
}