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
        Schema::table('beritas', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        // Generate slugs for existing records
        \DB::table('beritas')->get()->each(function ($berita) {
            if (empty($berita->slug)) {
                $slug = \Illuminate\Support\Str::slug($berita->judul);
                // Handle duplicates
                $originalSlug = $slug;
                $count = 1;
                while (\DB::table('beritas')->where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }
                \DB::table('beritas')->where('id', $berita->id)->update(['slug' => $slug]);
            }
        });

        // Now add unique constraint
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
            $table->dropColumn('slug');
        });
    }
};
