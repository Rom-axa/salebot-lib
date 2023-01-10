<?php

declare(strict_types=1);

namespace professionalweb\salebot\Models;

use professionalweb\salebot\Interfaces\Models\Message as IMessage;

class Message implements IMessage
{
    /** @var int */
    private $id;

    /** @var string */
    private $condition;

    /** @var string */
    private $answer;

    /** @var int */
    private $messageType;

    /** @var string */
    private $description;

    public function __construct(int $id = null, string $condition = '', string $answer = '', int $messageType = 0, string $description = '')
    {
        $this->setId($id)->setCondition($condition)->setAnswer($answer)->setMessageType($messageType)->setDescription($description);
    }

    /**
     * @param int $id
     *
     * @return Message
     */
    public function setId(int $id): Message
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $condition
     *
     * @return Message
     */
    public function setCondition(string $condition): Message
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * @param string $answer
     *
     * @return Message
     */
    public function setAnswer(string $answer): Message
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * @param int $messageType
     *
     * @return Message
     */
    public function setMessageType(int $messageType): Message
    {
        $this->messageType = $messageType;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return Message
     */
    public function setDescription(string $description): Message
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get message id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCondition(): string
    {
        return $this->condition;
    }

    /**
     * Get message text
     *
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * Get message type
     *
     * @return int
     */
    public function getMessageType(): int
    {
        return $this->messageType;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}