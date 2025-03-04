<?php

declare(strict_types=1);

namespace Salebot\Interfaces\Models;

/**
 * Interface for message attachment
 * @package Salebot\Interfaces\Models
 */
interface Attachment
{
    public const TYPE_IMAGE = 'image';

    public const TYPE_VIDEO = 'video';

    public const TYPE_LINK = 'link';

    public const TYPE_FILE = 'file';

    public const TYPE_AUDIO = 'audio';

    /**
     * Get attachment type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get attachment url
     *
     * @return string
     */
    public function getUrl(): string;
}