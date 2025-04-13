<?php

namespace App\Http\Controllers;

use App\Models\Pendaftars;
use App\Models\UserProfile;
use App\Models\SakramenEvent;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        $sakramenEventId = $request->query('sakramen_event_id');

        // Ambil data pendaftar berdasarkan sakramen_event_id
        $pendaftars = Pendaftars::with('sakramenEvent')->where('sakramen_event_id', $sakramenEventId)->get();

        return view('pendaftars.index', compact('pendaftars'));
    }

    public function show($id)
    {
        // Muat relasi sakramenEvent
        $pendaftar = Pendaftars::with('sakramenEvent')->findOrFail($id);

        return view('pendaftars.show', compact('pendaftar'));
    }
    public function updateStatus(Request $request, $id)
    {
        $pendaftar = Pendaftars::findOrFail($id);

        $request->validate([
            'status' => 'required|string|max:255',
            'alasan' => 'nullable|string|max:255',
        ]);

        $pendaftar->update([
            'status' => $request->status,
            'alasan' => $request->alasan,
        ]);

        return redirect()->route('pendaftars.show', $id)->with('success', 'Status berhasil diperbarui.');
    }

    public function tandaiSelesai($id)
    {
        $pendaftar = Pendaftars::findOrFail($id);
        $pendaftar->update(['status' => 'selesai', 'alasan' => 'silahkan mengunduh surat tanda sudah menerima sakramen dibawah ini untuk pengambilan sertifikat sakramen resmi yang sudah ditandatangani Pastor paroki. jangan lupa memperbarui data sakramen anda pada user-profile anda.']);

        $this->generatePdf($id);

        return redirect()->route('pendaftars.show', $id)->with('success', 'Pendaftaran telah ditandai selesai.');
    }

    public function generatePdf($id)
    {
        $pendaftar = Pendaftars::with('sakramenEvent')->findOrFail($id);

        // Tentukan nama file berdasarkan jenis sakramen
        $fileName = 'sertifikat_' . strtolower($pendaftar->jenis_sakramen) . '_' . $pendaftar->nama_lengkap . '_' . $pendaftar->sakramen_event_id . '.pdf';

        // Data yang akan dikirim ke view PDF
        $data = [
            'pendaftar' => $pendaftar,
            'sakramenEvent' => $pendaftar->sakramenEvent,
        ];

        // Render view menjadi PDF
        $pdf = Pdf::loadView('pdf.sakramen', $data);

        // Simpan file PDF ke storage/public
        $filePath = 'pdf/' . $fileName;
        Storage::disk('public')->put($filePath, $pdf->output());

        // Simpan path file ke database (opsional)
        $pendaftar->update(['sertifikat_path' => $filePath]);

        return $filePath; // Kembalikan path file untuk digunakan di aplikasi Flutter
    }

 
}
