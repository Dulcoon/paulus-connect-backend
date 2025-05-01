<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KalenderLiturgi;
use Illuminate\Http\Request;

class KalenderLiturgiApiController extends Controller
{
    /**
     * Get all Kalender Liturgi data.
     */
    public function index()
    {
        try {

            $kalenderLiturgi = KalenderLiturgi::all();


            return response()->json([
                'success' => true,
                'message' => 'Data Kalender Liturgi berhasil diambil.',
                'data' => $kalenderLiturgi,
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function showByDate(Request $request)
    {
        try {

            $request->validate([
                'date' => 'required|date',
            ]);


            $token = $request->header('Authorization');
            if (!$token || !str_starts_with($token, 'Bearer ')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token tidak valid atau tidak ditemukan.',
                ], 401);
            }


            $token = substr($token, 7);





            $kalenderLiturgi = KalenderLiturgi::where('date', $request->query('date'))->first();


            if (!$kalenderLiturgi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Kalender Liturgi tidak ditemukan untuk tanggal tersebut.',
                ], 404);
            }


            return response()->json([
                'success' => true,
                'message' => 'Data Kalender Liturgi berhasil ditemukan.',
                'data' => $kalenderLiturgi,
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}