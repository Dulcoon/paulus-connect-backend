<?php

namespace App\Http\Controllers;

use App\Models\Pendaftars;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        $sakramenEventId = $request->query('sakramen_event_id');

        // Ambil data pendaftar berdasarkan sakramen_event_id
        $pendaftars = Pendaftars::where('sakramen_event_id', $sakramenEventId)->get();

        return view('pendaftars.index', compact('pendaftars'));
    }

    public function show($id)
    {
        $pendaftar = Pendaftars::findOrFail($id);

        return view('pendaftars.show', compact('pendaftar'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pendaftar = Pendaftars::findOrFail($id);

        $request->validate([
            'status' => 'required|in:diproses,ditolak,diterima,selesai',
            'alasan' => 'nullable|string|max:255',
        ]);

        $pendaftar->update([
            'status' => $request->status,
            'alasan' => $request->alasan,
        ]);

        return redirect()->route('pendaftars.show', $id)->with('success', 'Status berhasil diperbarui.');
    }

 
}
