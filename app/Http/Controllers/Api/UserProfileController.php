<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\Wilayah;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'no_hp' => 'required|string',
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'kelamin' => 'required|String',
            'kecamatan_tempat_tinggal' => 'required|string',
            'kelurahan_id' => 'required|exists:wilayahs,id',
            'alamat_lengkap' => 'required|string',
            'baptis' => 'required|in:sudah,belum',
            'tanggal_baptis' => 'nullable|date',
            'tempat_baptis' => 'nullable|string',
            'komuni' => 'required|in:sudah,belum',
            'tanggal_komuni' => 'nullable|date',
            'tempat_komuni' => 'nullable|string',
            'krisma' => 'required|in:sudah,belum',
            'tanggal_krisma' => 'nullable|date',
            'tempat_krisma' => 'nullable|string',
        ]);

        // Dapatkan lingkungan berdasarkan kelurahan_id
        $wilayah = Wilayah::find($request->kelurahan_id);



        $profile = UserProfile::create([
            'user_id' => Auth::id(),
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelamin' => $request->kelamin,
            'kecamatan_tempat_tinggal' => $request->kecamatan_tempat_tinggal,
            'kelurahan_id' => $request->kelurahan_id,
            'lingkungan' => $wilayah->lingkungan,
            'alamat_lengkap' => $request->alamat_lengkap,
            'sudah_baptis' => $request->baptis,
            'tanggal_baptis' => $request->tanggal_baptis,
            'tempat_baptis' => $request->tempat_baptis,
            'sudah_komuni' => $request->komuni,
            'tanggal_komuni' => $request->tanggal_komuni,
            'tempat_komuni' => $request->tempat_komuni,
            'sudah_krisma' => $request->krisma,
            'tanggal_krisma' => $request->tanggal_krisma,
            'tempat_krisma' => $request->tempat_krisma,
        ]);
        
        $user = Auth::user();
        if ($user instanceof User) {
            $user->isCompleted = true;
            $user->save();
        } else {
            // Handle the case where $user is not an instance of User
            return response()->json(['error' => 'User not found or not authenticated'], 404);
        }


        return response()->json(['message' => 'Profil berhasil dibuat', 'profile' => $profile], 201);
    }

    public function show()
    {
        $profile = UserProfile::where('user_id', Auth::id())
        ->with('wilayah:nama_wilayah,id')
        ->first();
        if (!$profile) {
            return response()->json(['message' => 'Profil tidak ditemukan'], 404);
        }

        $profileArray = $profile->toArray();
        $profileArray['nama_wilayah'] = $profile->wilayah->nama_wilayah ?? null;
        unset($profileArray['wilayah']); 

        return response()->json($profileArray);
    }
}