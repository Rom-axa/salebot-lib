<?php

declare(strict_types=1);

namespace Salebot\Interfaces\Models;

/**
 * Interface for response
 * @package Salebot\Interfaces\Models
 */
interface Response
{
    public const STATUS_SUCCESS = 'success';

    public const STATUS_FAIL = 'fail';

    /**
     * Get command execution status
     *
     * @return string
     */
    public function getStatus(): string;

    /**
     * Check request is successful
     *
     * @return bool
     */
    public function isSuccess(): bool;

    /**
     * Check request failed
     *
     * @return bool
     */
    public function isFail(): bool;

    /**
     * Get payload
     *
     * @return array
     */
    public function getData(): array;
}