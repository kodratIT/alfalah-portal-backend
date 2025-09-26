<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProgramController extends Controller
{
    public function show(): JsonResponse
    {
        $program = Program::all();

        return response()->json([
            'status' => 'success',
            'data' => $program,
        ]);
    }

    public function index(): JsonResponse
    {
        $programs = Program::all()->map(function ($program) {
            // Decode keunggulan JSON if it's a string
            $keunggulan = is_string($program->keunggulan) ? json_decode($program->keunggulan, true) : $program->keunggulan;
            
            // Extract features - handle both array of strings and array of objects
            $features = [];
            if (is_array($keunggulan)) {
                foreach ($keunggulan as $item) {
                    if (is_string($item)) {
                        $features[] = $item;
                    } elseif (is_array($item) && isset($item['value'])) {
                        $features[] = $item['value'];
                    }
                }
            }
            
            return [
                'title' => $program->judul,
                'description' => $program->deskripsi,
                'features' => array_slice($features, 0, 3), // Limit to 3 features for display
                'duration' => $program->kategori_usia,
                'students' => $program->jumlah_santri,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $programs,
        ]);
    }
}
