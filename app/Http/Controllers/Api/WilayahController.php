<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wilayah;

use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        $wilayah = Wilayah::all(); // Ambil semua data wilayah
        return response()->json([
            'success' => true,
            'data' => $wilayah
        ]);
    }
}
