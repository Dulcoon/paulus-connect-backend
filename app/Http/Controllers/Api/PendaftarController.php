<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pendaftars;
use App\Models\SakramenEvent;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftarController extends Controller
{
    /**
     * Ambil data default untuk pendaftaran berdasarkan user_id.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDefaultData(Request $request)
    {
        $profile = UserProfile::where('user_id', Auth::id())->first();

        if (!$profile) {
            return response()->json([
                'data' => null,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'data' => [
                'nama' => $profile->nama_lengkap,
                'nama_ayah' => $profile->nama_ayah,
                'no_hp' => $profile->no_hp,
                'nama_ibu' => $profile->nama_ibu,
                'tempat_lahir' => $profile->tempat_lahir,
                'tanggal_lahir' => $profile->tanggal_lahir,
                'kelamin' => $profile->kelamin,
                'kecamatan' => $profile->kecamatan_tempat_tinggal,
                'kelurahan' => $profile->wilayah->nama_wilayah,
                'lingkungan' => $profile->lingkungan,
                'alamat' => $profile->alamat_lengkap,
            ]
        ]);
    }

    /**
     * Pendaftaran Sakramen
     */
    public function daftarSakramen(Request $request)
    {
        // Validasi input umum
        $validated = $request->validate([
            'sakramen_event_id' => 'required|exists:sakramen_events,id',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'lingkungan' => 'required|string|max:255',
        ]);

        // Ambil jenis sakramen dari event
        $sakramenEvent = SakramenEvent::findOrFail($validated['sakramen_event_id']);
        $jenisSakramen = $sakramenEvent->jenis_sakramen;

        // Tambahkan validasi file berdasarkan jenis sakramen
        $fileValidationRules = [
            'berkas_kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'berkas_akta_kelahiran' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];

        if ($jenisSakramen === 'Komuni' || $jenisSakramen === 'Krisma') {
            $fileValidationRules['berkas_surat_baptis'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048';
        }

        if ($jenisSakramen === 'Krisma') {
            $fileValidationRules['berkas_surat_komuni'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048';
        }

        // Validasi file
        $request->validate($fileValidationRules);

        // Simpan file yang diunggah
        $filePaths = [
            'berkas_kk' => $request->file('berkas_kk')->store('berkas_kk', 'public'),
            'berkas_akta_kelahiran' => $request->file('berkas_akta_kelahiran')->store('berkas_akta_kelahiran', 'public'),
            'berkas_surat_baptis' => $request->file('berkas_surat_baptis') ? $request->file('berkas_surat_baptis')->store('berkas_surat_baptis', 'public') : null,
            'berkas_surat_komuni' => $request->file('berkas_surat_komuni') ? $request->file('berkas_surat_komuni')->store('berkas_surat_komuni', 'public') : null,
        ];

        // Periksa apakah data sudah ada
        $pendaftar = Pendaftars::where('user_id', $request->user()->id)
            ->where('sakramen_event_id', $validated['sakramen_event_id'])
            ->first();

        if ($pendaftar) {
            // Update data yang sudah ada
            $pendaftar->update(array_merge($validated, $filePaths, [
                'jenis_sakramen' => $jenisSakramen,
                'status' => 'Menunggu konfirmasi',
            ]));
        } else {
            // Buat data baru
            $pendaftar = Pendaftars::create(array_merge($validated, $filePaths, [
                'user_id' => $request->user()->id,
                'jenis_sakramen' => $jenisSakramen,
                'status' => 'Menunggu konfirmasi',
            ]));
        }

        return response()->json([
            'success' => true,
            'message' => "Pendaftaran $jenisSakramen berhasil!",
            'data' => $pendaftar,
        ]);
    }


    public function checkRegistration(Request $request)
    {
        // Validasi input
        $request->validate([
            'sakramen_event_id' => 'required|exists:sakramen_events,id',
        ]);

        // Ambil ID pengguna yang sedang login
        $userId = $request->user()->id;
        $sakramenEventId = $request->sakramen_event_id;

        // Periksa apakah pengguna sudah mendaftar untuk event ini
        $registration = Pendaftars::where('user_id', $userId)
            ->where('sakramen_event_id', $sakramenEventId)
            ->first();

        if ($registration) {
            return response()->json([
                'registered' => true,
                'status' => $registration->status,
                'alasan' => $registration->alasan,
            ]);
        }

        // Jika tidak ditemukan, kembalikan respons default
        return response()->json([
            'registered' => false,
            'status' => null,
            'alasan' => null,
        ]);
    }
}
