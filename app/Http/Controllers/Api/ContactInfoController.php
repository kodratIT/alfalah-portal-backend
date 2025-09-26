<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ContactInfoController extends Controller
{
        public function show(): JsonResponse
    {
        $profile = ContactInfo::first(); // atau find(1), tergantung data

        return response()->json([
            'status' => 'success',
            'data' => $profile,
        ]);
    }
}
