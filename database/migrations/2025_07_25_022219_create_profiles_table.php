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
        Schema::create('profiles', function (Blueprint $table) {
               $table->id();
                $table->string('judul');
                $table->text('deskripsi');
                $table->longText('sejarah');
                $table->string('gambar_sejarah')->nullable();
                $table->string('tahun_berdiri');
                $table->longText('visi');
                $table->json('misi');
                $table->json('fasilitas');
                $table->json('pimpinan');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
