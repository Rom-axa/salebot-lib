<?php

declare(strict_types=1);

namespace professionalweb\salebot\Interfaces\Models;

interface Client
{
    public const TYPE_VK = 0;

    public const TYPE_TELEGRAM = 1;

    public const TYPE_VIBER = 2;

    public const TYPE_FB = 3;

    public const TYPE_TALKME = 4;

    public const TYPE_ONLINE_CHAT = 5;

    public const TYPE_WHATSAPP = 6;

    public const TYPE_AVITO = 7;

    public const TYPE_OK = 8;

    public const TYPE_INSTAGRAM = 10;

    public const TYPE_JIVOSITE = 11;

    public const TYPE_ULA = 12;

    /**
     * Get client id
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Get group id
     *
     * @return string
     */
    public function getGroupId(): string;

    /**
     * Get platform id
     *
     * @return string
     */
    public function getPlatformId(): string;

    /**
     * Get client type
     *
     * @return string
     */
    public function getClientType(): string;

    /**
     * Client to array
     *
     * @return array
     */
    public function toArray(): array;
}