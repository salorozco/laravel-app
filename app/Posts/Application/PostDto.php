<?php

namespace App\Posts\Application;

use DateTime;

class PostDto
{
    private string $id;
    private string $title;
    private string $body;
    private int $userId;
    private string $slug;
    private string $featuredImage;
    private int $views;
    private ?DateTime $publishedAt;
    private DateTime $createdAt;

    public function __construct(
        string $id,
        string $title,
        string $body,
        int $userId,
        string $slug,
        string $featuredImage,
        int $views,
        ?DateTime $publishedAt,
        DateTime $createdAt
    ){
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->userId = $userId;
        $this->slug = $slug;
        $this->featuredImage = $featuredImage;
        $this->views = $views;
        $this->publishedAt = $publishedAt;
        $this->createdAt = $createdAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function getFeaturedImage(): string
    {
        return $this->featuredImage;
    }

    public function getPublishedAt(): ?DateTime
    {
        return $this->publishedAt;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
