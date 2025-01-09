<?php

namespace App\Framework\Http\Resources;

use App\Users\Application\UserDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
            'user_id' => $this->getUserId(), // User ID
            'slug' => $this->getSlug(),
            'status' => $this->getStatus(),
            'featured_image' => $this->getFeaturedImage(),
            'views' => $this->getViews(),
            'published_at' => $this->getPublishedAt(),
            'created_at' => $this->getCreatedAt(),
            'user' => new UserResource($this->getUser())
        ];
    }
}
