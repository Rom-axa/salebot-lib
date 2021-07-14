<?php namespace professionalweb\salebot\Interfaces\Models;

/**
 * Interface button
 * @package professionalweb\salebot\Interfaces\Models
 */
interface Button
{
    public const TYPE_REPLY = 'reply';

    public const TYPE_INLINE = 'inline';

    public const TYPE_LOCATION = 'location';

    public const TYPE_PHONE = 'phone';

    /**
     * Get button type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * Get button color
     *
     * @return string
     */
    public function getColor(): string;

    /**
     * Get button text
     *
     * @return string
     */
    public function getText(): string;

    /**
     * Get line index
     *
     * @return int
     */
    public function getLine(): int;

    /**
     * Get index in line
     *
     * @return int
     */
    public function getIndexInLine(): int;

    /**
     * Hide button or not
     *
     * @return bool
     */
    public function isOneTime(): bool;

    /**
     * Button to array
     *
     * @return array
     */
    public function toArray(): array;
}