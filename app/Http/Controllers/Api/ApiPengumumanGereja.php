<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\pengumumanGereja;
use Illuminate\Http\JsonResponse;

class ApiPengumumanGereja extends Controller
{
    /**
     * Menampilkan daftar pengumuman gereja.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Ambil semua pengumuman, urutkan berdasarkan tanggal terbaru
        $pengumuman = pengumumanGereja::orderBy('tanggal_pengumuman', 'desc')->get();

        // Hanya tampilkan nama file gambar
        $pengumuman->transform(function ($item) {
            if ($item->gambar) {
                $item->gambar = basename($item->gambar); // Ambil hanya nama file
            }
            return $item;
        });

        // Kembalikan data dalam format JSON
        return response()->json([
            'success' => true,
            'data' => $pengumuman,
        ]);
    }

    /**
     * Menampilkan detail pengumuman berdasarkan ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        // Cari pengumuman berdasarkan ID
        $pengumuman = pengumumanGereja::find($id);

        // Jika pengumuman tidak ditemukan, kembalikan error
        if (!$pengumuman) {
            return response()->json([
                'success' => false,
                'message' => 'Pengumuman tidak ditemukan',
            ], 404);
        }

        // Hanya tampilkan nama file gambar
        if ($pengumuman->gambar) {
            $pengumuman->gambar = basename($pengumuman->gambar); // Ambil hanya nama file
        }

        // Kembalikan data pengumuman dalam format JSON
        return response()->json([
            'success' => true,
            'data' => $pengumuman,
        ]);
    }
}