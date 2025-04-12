<?php

namespace App\Http\Controllers;

use App\Models\pengumumanGereja;
use Illuminate\Http\Request;

class pengumumanController extends Controller
{
    /**
     * Tampilkan daftar pengumuman.
     */
    public function index()
    {
        $pengumuman = pengumumanGereja::latest()->paginate(10); // Pagination untuk daftar pengumuman
        return view('pengumuman.index', compact('pengumuman'));
    }

    /**
     * Tampilkan form untuk membuat pengumuman baru.
     */
    public function create()
    {
        return view('pengumuman.create');
    }

    /**
     * Simpan pengumuman baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'tanggal_pengumuman' => 'required|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['gambar'] = 'images/' . $filename;
        }

        pengumumanGereja::create($data);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail pengumuman.
     */
    public function show($id)
    {
        $pengumuman = pengumumanGereja::findOrFail($id);
        return view('pengumuman.show', compact('pengumuman'));
    }

    /**
     * Tampilkan form untuk mengedit pengumuman.
     */
    public function edit($id)
    {
        $pengumuman = pengumumanGereja::findOrFail($id);
        return view('pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Perbarui pengumuman di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'tanggal_pengumuman' => 'required|date',
        ]);

        $pengumuman = pengumumanGereja::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($pengumuman->gambar && file_exists(public_path($pengumuman->gambar))) {
                unlink(public_path($pengumuman->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['gambar'] = 'images/' . $filename;
        }

        $pengumuman->update($data);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Hapus pengumuman dari database.
     */
    public function destroy($id)
    {
        $pengumuman = pengumumanGereja::findOrFail($id);

        // Hapus gambar jika ada
        if ($pengumuman->gambar && file_exists(public_path($pengumuman->gambar))) {
            unlink(public_path($pengumuman->gambar));
        }

        $pengumuman->delete();

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}