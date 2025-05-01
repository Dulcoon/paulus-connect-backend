<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MisaPdf;

class textMisaApiController extends Controller
{
    public function index()
    {
        $misaPdfs = MisaPdf::all();
        if ($misaPdfs->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No Misa PDFs found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $misaPdfs,
        ]);
    }
}