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
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->text('alamat');
            $table->string('telepon_kantor')->nullable();
            $table->string('telepon_hp')->nullable();
            $table->string('telepon_wa')->nullable();
            $table->json('emails')->nullable();
            $table->string('jam_kerja_senin_jumat')->nullable();
            $table->string('jam_kerja_sabtu')->nullable();
            $table->string('jam_kerja_minggu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_infos');
    }
};
