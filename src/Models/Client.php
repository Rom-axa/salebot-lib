<?php

declare(strict_types=1);

namespace professionalweb\salebot\Models;

use professionalweb\salebot\Interfaces\Models\Client as IClient;

/**
 * Client
 * @package professionalweb\salebot\Models
 */
class Client implements IClient
{
    /** @var string */
    private $id = '';

    /** @var string */
    private $platformId = '';

    /** @var string */
    private $groupId = '';

    /** @var string */
    private $clientType = '';

    /**
     * @param string $id
     *
     * @return Client
     */
    public function setId(string $id): Client
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $platformId
     *
     * @return Client
     */
    public function setPlatformId(string $platformId): Client
    {
        $this->platformId = $platformId;

        return $this;
    }

    /**
     * @param string $groupId
     *
     * @return Client
     */
    public function setGroupId(string $groupId): Client
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @param string $clientType
     *
     * @return Client
     */
    public function setClientType(string $clientType): Client
    {
        $this->clientType = $clientType;

        return $this;
    }

    /**
     * Get client id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get group id
     *
     * @return string
     */
    public function getGroupId(): string
    {
        return $this->groupId;
    }

    /**
     * Get platform id
     *
     * @return string
     */
    public function getPlatformId(): string
    {
        return $this->platformId;
    }

    /**
     * Get client type
     *
     * @return string
     */
    public function getClientType(): string
    {
        return $this->clientType;
    }

    /**
     * Client to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'platform_id' => $this->getPlatformId(),
            'group_id'    => $this->getGroupId(),
            'client_type' => $this->getClientType(),
        ];
    }
}