<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TestimonialController extends Controller
{
    public function show(): JsonResponse
    {
        $testimoni = Testimonial::latest()->paginate(3);

        return response()->json([
            'status' => 'success',
            'data' => $testimoni,
        ]);
    }
}
