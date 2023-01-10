<?php

declare(strict_types=1);

namespace professionalweb\salebot\Interfaces\Models;

/**
 * Interface for Message model
 * @package professionalweb\salebot\Interfaces\Models
 */
interface Message
{
    /**
     * Get message id
     *
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getCondition(): string;

    /**
     * Get message text
     *
     * @return string
     */
    public function getAnswer(): string;

    /**
     * Get message type
     *
     * @return int
     */
    public function getMessageType(): int;

    /**
     * @return string
     */
    public function getDescription(): string;
}
