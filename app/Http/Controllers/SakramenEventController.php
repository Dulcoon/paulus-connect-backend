<?php

namespace App\Http\Controllers;
use App\Models\SakramenEvent;
use Illuminate\Http\Request;

class SakramenEventController extends Controller
{
    public function index()
    {
        $events = SakramenEvent::all();
        return view('sakramen-events.index', compact('events'));
    }

    public function create()
    {
        return view('sakramen-events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'jenis_sakramen' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'tempat_pelaksanaan' => 'required|string|max:255',
            'nama_romo' => 'required|string|max:255',
            'tanggal_pendaftaran_dibuka' => 'required|date',
            'tanggal_pendaftaran_ditutup' => 'required|date|after_or_equal:tanggal_pendaftaran_dibuka',
            'kuota_pendaftar' => 'required|integer|min:1',
        ]);
    
        // Tambahkan status default menjadi 'opened'
        $data = $request->all();
        $data['status'] = 'opened';
    
        SakramenEvent::create($data);
        
    
        return redirect()->route('sakramen-events.index')->with('success', 'Sakramen Event berhasil ditambahkan.');
    }

    public function edit(SakramenEvent $sakramenEvent)
    {
        return view('sakramen-events.edit', compact('sakramenEvent'));
    }

    public function update(Request $request, SakramenEvent $sakramenEvent)
    {
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'jenis_sakramen' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'tempat_pelaksanaan' => 'required|string|max:255',
            'nama_romo' => 'required|string|max:255',
            'tanggal_pendaftaran_dibuka' => 'required|date',
            'tanggal_pendaftaran_ditutup' => 'required|date|after_or_equal:tanggal_pendaftaran_dibuka',
            'kuota_pendaftar' => 'required|integer|min:1',
            'status' => 'required|in:opened,closed',
        ]);

        $sakramenEvent->update($request->all());
        return redirect()->route('sakramen-events.index')->with('success', 'sakramen Event berhasil diperbarui.');
    }

    public function destroy(SakramenEvent $sakramenEvent)
    {
        $sakramenEvent->delete();
        return redirect()->route('sakramen-events.index')->with('success', 'sakramen Event berhasil dihapus.');
    }
}
