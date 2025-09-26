<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function show(): JsonResponse
    {
        $profile = Profile::first(); // atau find(1), tergantung data

        return response()->json([
            'status' => 'success',
            'data' => $profile,
        ]);
    }
}
