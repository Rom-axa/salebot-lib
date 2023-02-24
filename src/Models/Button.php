<?php

declare(strict_types=1);

namespace Salebot\Models;

use Salebot\Interfaces\Models\Button as IButton;

/**
 * Button
 * @package Salebot\Models
 */
class Button implements IButton
{
    /** @var string */
    private $type;

    /** @var string|null */
    private $url = null;

    /** @var string */
    private $color;

    /** @var string */
    private $text;

    /** @var int */
    private $line;

    /** @var int */
    private $indexInLine;

    /** @var bool */
    private $oneTime;

    /**
     * @param string $type
     *
     * @return Button
     */
    public function setType(string $type): Button
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string|null $url
     *
     * @return Button
     */
    public function setUrl(?string $url): Button
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param string $color
     *
     * @return Button
     */
    public function setColor(string $color): Button
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @param string $text
     *
     * @return Button
     */
    public function setText(string $text): Button
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param int $line
     *
     * @return Button
     */
    public function setLine(int $line): Button
    {
        $this->line = $line;

        return $this;
    }

    /**
     * @param int $indexInLine
     *
     * @return Button
     */
    public function setIndexInLine(int $indexInLine): Button
    {
        $this->indexInLine = $indexInLine;

        return $this;
    }

    /**
     * @param bool $oneTime
     *
     * @return Button
     */
    public function setOneTime(bool $oneTime): Button
    {
        $this->oneTime = $oneTime;

        return $this;
    }

    /**
     * Get button type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get url
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Get button color
     *
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Get button text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Get line index
     *
     * @return int
     */
    public function getLine(): int
    {
        return $this->line;
    }

    /**
     * Get index in line
     *
     * @return int
     */
    public function getIndexInLine(): int
    {
        return $this->indexInLine;
    }

    /**
     * Hide button or not
     *
     * @return bool
     */
    public function isOneTime(): bool
    {
        return $this->oneTime;
    }

    /**
     * Button to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type'          => $this->getType(),
            'text'          => $this->getText(),
            'line'          => $this->getLine(),
            'index_in_line' => $this->getIndexInLine(),
            'color'         => $this->getColor(),
            'one_time'      => $this->isOneTime() ? 1 : 0,
        ] + ($this->getUrl() === null ? [] : ['url' => $this->getUrl()]);
    }
}