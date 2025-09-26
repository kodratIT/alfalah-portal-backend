<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
     public function index(Request $request)
    {
        $query = Gallery::query();

        // Filter opsional berdasarkan kategori
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Filter populer
        if ($request->boolean('featured')) {
            $query->where('is_featured', true);
        }

        // Pagination opsional
        $galleries = $query->latest()->paginate(12); // sesuaikan jumlah per page jika perlu

        return response()->json([
            'success' => true,
            'data' => $galleries,
        ]);
    }

    // Detail galeri (jika dibutuhkan)
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $gallery,
        ]);
    }
}
