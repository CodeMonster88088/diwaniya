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
    Schema::create('audio_recordings', function (Blueprint $table) {
        $table->id();

        $table->foreignId('category_id')
            ->nullable()
            ->constrained('categories')
            ->nullOnDelete();

        $table->string('title');
        $table->string('slug')->unique();

        $table->text('description')->nullable();

        $table->string('speaker')->nullable();

        $table->date('recorded_at')->nullable();

        $table->string('location')->nullable();

        $table->string('filename');
        $table->string('original_filename')->nullable();

        $table->string('mime_type')->nullable();

        $table->unsignedInteger('duration')->nullable();

        $table->unsignedBigInteger('file_size')->nullable();

        $table->longText('transcript')->nullable();

        $table->boolean('is_published')->default(true);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audio_recordings');
    }
};
