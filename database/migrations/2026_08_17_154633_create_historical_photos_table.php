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
    Schema::create('historical_photos', function (Blueprint $table) {
        $table->id();

        $table->foreignId('category_id')
            ->nullable()
            ->constrained('categories')
            ->nullOnDelete();

        $table->string('title');
        $table->string('slug')->unique();

        $table->text('description')->nullable();

        $table->string('filename');
        $table->string('original_filename')->nullable();

        $table->date('photographed_at')->nullable();

        $table->string('location')->nullable();

        $table->text('people')->nullable();

        $table->string('photographer')->nullable();

        $table->boolean('is_published')->default(true);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historical_photos');
    }
};
