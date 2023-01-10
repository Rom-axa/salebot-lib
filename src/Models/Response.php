<?php

declare(strict_types=1);

namespace professionalweb\salebot\Models;

use professionalweb\salebot\Interfaces\Models\Response as IResponse;

class Response implements IResponse
{
    /** @var string */
    private $status;

    /** @var array */
    private $data;

    public function __construct(string $status = self::STATUS_SUCCESS, array $payload = [])
    {
        $this->setStatus($status)->setData($payload);
    }

    /**
     * @param string $status
     *
     * @return Response
     */
    public function setStatus(string $status): Response
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param array $data
     *
     * @return Response
     */
    public function setData(array $data): Response
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get command execution status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status ?? self::STATUS_FAIL;
    }

    /**
     * Get payload
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data ?? [];
    }

    /**
     * Check request is successful
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->getStatus() === self::STATUS_SUCCESS;
    }

    /**
     * Check request failed
     *
     * @return bool
     */
    public function isFail(): bool
    {
        return $this->getStatus() === self::STATUS_FAIL;
    }
}