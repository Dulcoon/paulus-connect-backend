<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\MisaPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class textMisaController extends Controller
{
    public function index()
    {
        $misaPdfs = MisaPdf::all();
        return view('text-misa.index', compact('misaPdfs'));
    }

    public function create()
    {
        return view('text-misa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Simpan file PDF
        $filePath = $request->file('file')->store('misa_pdfs', 'public');

        // Simpan data ke database
        MisaPdf::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'file_path' => $filePath,
        ]);

        return redirect()->route('text-misa.index')->with('success', 'Teks misa berhasil diunggah.');
    }

    public function destroy(MisaPdf $misaPdf)
    {
        // Hapus file dari storage
        if (Storage::disk('public')->exists($misaPdf->file_path)) {
            Storage::disk('public')->delete($misaPdf->file_path);
        }

        // Hapus data dari database
        $misaPdf->delete();

        return redirect()->route('text-misa.index')->with('success', 'Teks misa berhasil dihapus.');
    }
}