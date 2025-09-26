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
        // Generate unique slugs for existing records
        \DB::table('beritas')->whereNull('slug')->orWhere('slug', '')->get()->each(function ($berita) {
            $slug = \Illuminate\Support\Str::slug($berita->judul);
            $originalSlug = $slug;
            $count = 1;
            while (\DB::table('beritas')->where('slug', $slug)->where('id', '!=', $berita->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            \DB::table('beritas')->where('id', $berita->id)->update(['slug' => $slug]);
        });

        Schema::table('beritas', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropUnique(['slug']);
        });
    }
};
