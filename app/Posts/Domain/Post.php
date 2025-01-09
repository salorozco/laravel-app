<?php

namespace App\Posts\Domain;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use DatetimeImmutable;

class Post
{
    private UuidInterface $uuid;
    private string $title;
    private string $body;
    private int $userId;
    private string $slug;
    private string $status;
    private string $featuredImage;
    private int $views;
    private DateTimeImmutable $publishedAt;

    private function __construct(
        UuidInterface $uuid,
        string $title,
        string $body,
        int $userId,
        string $slug,
        string $status,
        string $featuredImage,
        int $views,
        DateTimeImmutable $publishedAt,
    ){
        $this->uuid = $uuid;
        $this->title = $title;
        $this->body = $body;
        $this->userId = $userId;
        $this->slug = $slug;
        $this->status = $status;
        $this->featuredImage = $featuredImage;
        $this->views = $views;
        $this->publishedAt = $publishedAt;
    }

    public static function submit(
        string $title,
        string $body,
        int $userId,
        string $slug,
        string $status,
        string $featuredImage,
        int $views,
        DateTimeImmutable $publishedAt

    ): Post {
        return new Post(
            Uuid::uuid4(),
            $title,
            $body,
            $userId,
            $slug,
            $status,
            $featuredImage,
            $views,
            $publishedAt
        );
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getFeaturedImage(): string
    {
        return $this->featuredImage;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function getPublishedAt(): DatetimeImmutable
    {
        return $this->publishedAt;
    }

}
