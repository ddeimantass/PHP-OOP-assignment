<?php

declare(strict_types=1);

namespace App\DTO;

class PostModel
{
    private string $id;
    private string $fromName;
    private string $fromId;
    private string $message;
    private string $type;
    private \DateTime $createdTime;

    /**
     * @param string $id
     * @param string $fromName
     * @param string $fromId
     * @param string $message
     * @param string $type
     * @param \DateTime $createdTime
     */
    public function __construct(
        string $id,
        string $fromName,
        string $fromId,
        string $message,
        string $type,
        \DateTime $createdTime
    ) {
        $this->id = $id;
        $this->fromName = $fromName;
        $this->fromId = $fromId;
        $this->message = $message;
        $this->type = $type;
        $this->createdTime = $createdTime;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFromName(): string
    {
        return $this->fromName;
    }

    /**
     * @return string
     */
    public function getFromId(): string
    {
        return $this->fromId;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedTime(): \DateTime
    {
        return $this->createdTime;
    }
}
