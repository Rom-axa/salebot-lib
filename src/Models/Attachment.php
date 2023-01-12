<?php

declare(strict_types=1);

namespace professionalweb\salebot\Models;

use professionalweb\salebot\Interfaces\Models\Attachment as IAttachment;

class Attachment implements IAttachment
{
    protected $type;
    protected $url;

    public function __construct(string $type, string $url)
    {
        $this->type = $type;
        $this->url = $url;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @inheritDoc
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}