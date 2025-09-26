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
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_donatur')->nullable(); // Bisa kosong jika anonim
            $table->string('nomor_hp')->nullable();
            $table->string('email')->nullable();

            $table->date('tanggal');
            $table->string('jenis_donasi'); // Contoh: Infaq, Zakat, Wakaf, dll.
            $table->decimal('jumlah', 15, 2);
            $table->string('metode_pembayaran')->nullable(); // Tunai, Transfer, dll.
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};
