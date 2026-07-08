<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('business_field');
            $table->text('description');
            $table->string('address');
            $table->unsignedTinyInteger('rw');
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->string('cover_path')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('gmaps_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
