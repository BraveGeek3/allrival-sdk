<?php

namespace AllrivalSDK\Types;

use AllrivalSDK\Tools\Converter;
use DateTime;

class ClusterType implements TypeInterface
{
    private int $id;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private int $yourProductId;
    private int $rivalProductId;
    private string $highlitedName;
    private float $score;
    private bool $mistake;
    private bool $approved;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = Converter::convertStrToDt($createdAt);

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     * @return void
     */
    public function setUpdatedAt(string $updatedAt): self
    {
        $this->updatedAt = Converter::convertStrToDt($updatedAt);

        return $this;
    }

    /**
     * @return int
     */
    public function getYourProductId(): int
    {
        return $this->yourProductId;
    }

    /**
     * @param int $yourProductId
     */
    public function setYourProductId(int $yourProductId): self
    {
        $this->yourProductId = $yourProductId;

        return $this;
    }

    /**
     * @return int
     */
    public function getRivalProductId(): int
    {
        return $this->rivalProductId;
    }

    /**
     * @param int $rivalProductId
     */
    public function setRivalProductId(int $rivalProductId): self
    {
        $this->rivalProductId = $rivalProductId;

        return $this;
    }

    /**
     * @return string
     */
    public function getHighlitedName(): string
    {
        return $this->highlitedName;
    }

    /**
     * @param string $highlitedName
     */
    public function setHighlitedName(string $highlitedName): self
    {
        $this->highlitedName = $highlitedName;

        return $this;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @param float $score
     */
    public function setScore(float $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMistake(): bool
    {
        return $this->mistake;
    }

    /**
     * @param bool $mistake
     */
    public function setMistake(bool $mistake): self
    {
        $this->mistake = $mistake;

        return $this;
    }

    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->approved;
    }

    /**
     * @param bool $approved
     */
    public function setApproved(bool $approved): self
    {
        $this->approved = $approved;

        return $this;
    }
}