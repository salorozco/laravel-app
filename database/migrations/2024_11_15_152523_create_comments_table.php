<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('likes_count')->default(0);
            $table->timestamps();
        });

        Schema::create('comment_user', function (Blueprint $table) {
            $table->unsignedBigInteger('comment_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->primary(['comment_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_user');
        Schema::dropIfExists('comments');
    }
};
