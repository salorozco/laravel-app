<?php

namespace App\Posts\Application;

use App\Users\Application\UserDto;
use DateTime;

class PostDto
{
    private string $id;
    private string $title;
    private string $body;
    private int $userId;
    private string $slug;
    private string $status;
    private string $featuredImage;
    private int $views;
    private ?DateTime $publishedAt;
    private DateTime $createdAt;
    private UserDto $user;

    public function __construct(
        string $id,
        string $title,
        string $body,
        int $userId,
        string $slug,
        string $status,
        string $featuredImage,
        int $views,
        ?DateTime $publishedAt,
        DateTime $createdAt,
        UserDto $user
    ){
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->userId = $userId;
        $this->slug = $slug;
        $this->status = $status;
        $this->featuredImage = $featuredImage;
        $this->views = $views;
        $this->publishedAt = $publishedAt;
        $this->createdAt = $createdAt;
        $this->user = $user;
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

    public function getStatus(): string
    {
        return $this->status;
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

    public function getUser(): UserDto
    {
        return $this->user;
    }
}
