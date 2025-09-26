<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{

        // GET /api/berita
    public function index(Request $request)
    {
        $perPage = $request->get('limit', 9);
        $berita = Berita::latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $berita,
        ]);
    }

    // GET /api/berita/{slug}
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->first();

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $berita,
        ]);
    }
}
