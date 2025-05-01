<?php

namespace App\Http\Controllers;

use App\Models\KalenderLiturgi;
use Illuminate\Http\Request;

class KalenderLiturgiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kalenderLiturgi = KalenderLiturgi::paginate(10); // Ambil data dengan pagination (10 item per halaman)
        return view('kalender.index', compact('kalenderLiturgi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kalender.create'); // Tampilkan form untuk membuat data baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'warna_liturgi' => 'required|string|max:50',
            'bacaan1' => 'required|string|max:255',
            'mazmur' => 'required|string|max:255',
            'bacaan2' => 'nullable|string|max:255',
            'bait_pengantar' => 'nullable|string|max:255',
            'bacaan_injil' => 'required|string|max:255',
        ]);

        KalenderLiturgi::create($request->all()); // Simpan data ke database

        return redirect()->route('kalender-liturgi.index')->with('success', 'Kalender Liturgi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KalenderLiturgi $kalenderLiturgi)
    {
        return view('kalender.show', compact('kalenderLiturgi')); // Tampilkan detail data
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KalenderLiturgi $kalenderLiturgi)
    {
        return view('kalender.edit', compact('kalenderLiturgi')); // Tampilkan form edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KalenderLiturgi $kalenderLiturgi)
    {
        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'warna_liturgi' => 'required|string|max:50',
            'bacaan1' => 'required|string|max:255',
            'mazmur' => 'required|string|max:255',
            'bacaan2' => 'nullable|string|max:255',
            'bait_pengantar' => 'nullable|string|max:255',
            'bacaan_injil' => 'required|string|max:255',
        ]);

        $kalenderLiturgi->update($request->all()); // Perbarui data di database

        return redirect()->route('kalender-liturgi.index')->with('success', 'Kalender Liturgi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KalenderLiturgi $kalenderLiturgi)
    {
        $kalenderLiturgi->delete(); // Hapus data dari database

        return redirect()->route('kalender-liturgi.index')->with('success', 'Kalender Liturgi berhasil dihapus.');
    }
}