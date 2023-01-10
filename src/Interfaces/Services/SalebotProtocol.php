<?php

declare(strict_types=1);

namespace professionalweb\salebot\Interfaces\Services;

use professionalweb\salebot\Interfaces\Models\Response;

/**
 * Interface for salebot protocol
 * @package professionalweb\salebot\Interfaces\Services
 */
interface SalebotProtocol
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