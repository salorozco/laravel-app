<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $fillable = ['content', 'commentable_id', 'commentable_type', 'parent_id'];

    // Polymorphic relationship: Comment belongs to a model
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    // Recursive relationship: Comment can have replies
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Recursive relationship: Comment can have a parent comment
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Many-to-many relationship: Comment can be liked by many users
    public function likes()
    {
        return $this->belongsToMany(User::class, 'comment_user')->withTimestamps();
    }

    // Increment likes count
    public function incrementLikesCount(): void
    {
        $this->increment('likes_count');
    }

    // Decrement likes count
    public function decrementLikesCount(): void
    {
        $this->decrement('likes_count');
    }
}
