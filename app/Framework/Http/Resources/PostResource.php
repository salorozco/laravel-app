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
        // Get the user model if it's loaded
        $userModel = $this->whenLoaded('user');

        // If the user is loaded, create a UserDto
        $userDto = $userModel ? new UserDto(
            $userModel->id,
            $userModel->name,
            $userModel->email,
            $userModel->created_at
        ) : null;

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
            'updated_at' => $this->getUpdatedAt(),
            'user' => $userDto ? new UserResource($userDto) : null, // Eager load the user resource
        ];
    }
}
