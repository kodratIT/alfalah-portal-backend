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
        Schema::create('galleries', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('thumbnail')->nullable(); // bisa untuk gambar
                $table->enum('category', ['Semua', 'Fasilitas', 'Kegiatan', 'Pembelajaran', 'Prestasi']);
                $table->enum('type', ['Foto', 'Video'])->default('Foto');
                $table->string('video_url')->nullable(); // jika ada video
                $table->boolean('is_featured')->default(false); // untuk label 'Populer'
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
