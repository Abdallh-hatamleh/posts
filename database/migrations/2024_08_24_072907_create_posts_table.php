<?php

use App\Models\post;
use App\Models\tag;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('body');
            $table->timestamps();
        });
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(post::class);
            $table->foreignIdFor(tag::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('post_tag');
    }
};
