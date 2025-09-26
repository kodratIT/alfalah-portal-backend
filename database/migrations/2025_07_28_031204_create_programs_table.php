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
            Schema::create('programs', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->text('deskripsi')->nullable();
                $table->string('kategori_usia')->nullable(); // e.g. "3 Tahun", "6 Tahun"
                $table->string('jumlah_santri')->nullable(); // e.g. "100 Santri"
                $table->string('biaya')->nullable(); // e.g. "Gratis", "Rp 500rb/bln"
                $table->string('gambar')->nullable();
                $table->json('keunggulan')->nullable(); // array of strings
                $table->json('jadwal')->nullable(); // array of strings
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
