<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class AuthController extends Controller
{

    public function loginWithGoogle(Request $request)
    {
        $request->validate([
            'id_token' => 'required|string',
        ]);
    
        // Verifikasi token ke Google
        $googleResponse = Http::get('https://oauth2.googleapis.com/tokeninfo', [
            'id_token' => $request->id_token,
        ]);
    
        if (!$googleResponse->ok()) {
            return response()->json(['message' => 'Invalid ID token'], 401);
        }
    
        $googleUser = $googleResponse->json();
    
        // Ambil user atau buat baru
        $user = User::firstOrCreate(
            ['email' => $googleUser['email']],
            [
                'name' => $googleUser['name'] ?? 'Unknown',
                'password' => Hash::make(Str::random(24)), // dummy password
                'role' => 'user',
                'isCompleted' => false,
            ]
        );
    
        // Buat token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
    
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 'user',
            'isCompleted' => false,
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $data['email'])->first();

        // Check password
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function sendOtp(Request $request)
    {
        // Validasi email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email yang Anda masukkan belum terdaftar.',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        // Generate OTP
        $otp = rand(1000, 9999);
    
        // Simpan OTP ke database
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['otp' => $otp, 'created_at' => now()]
        );
    
        // Kirim OTP ke email
        Mail::raw("Kode OTP Anda adalah: $otp", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Kode OTP Reset Password');
        });
    
        return response()->json(['message' => 'Kode OTP telah dikirim ke email Anda.']);
    }
    
        public function verifyOtp(Request $request)
        {
            // Validasi input
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'otp' => 'required|digits:4',
            ]);
    
            // Periksa OTP di database
            $otpRecord = DB::table('password_resets')
                ->where('email', $request->email)
                ->where('otp', $request->otp)
                ->first();
    
            if (!$otpRecord) {
                return response()->json(['message' => 'Kode OTP tidak valid.'], 400);
            }
    
            // Hapus OTP setelah berhasil diverifikasi
            // DB::table('password_resets')->where('email', $request->email)->delete();
    
            return response()->json(['message' => 'OTP valid.']);
        }
        public function resetPassword(Request $request)
        {
            // Validasi input
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'otp' => 'required|digits:4', // Validasi OTP
                'password' => 'required|min:8|confirmed',
            ]);
        
            // Periksa OTP di database
            $otpRecord = DB::table('password_resets')
                ->where('email', $request->email)
                ->where('otp', $request->otp)
                ->first();
        
            if (!$otpRecord || now()->diffInMinutes($otpRecord->created_at) > 10) {
                return response()->json(['message' => 'OTP tidak valid atau sudah kedaluwarsa.'], 400);
            }
        
            // Perbarui password
            $user = User::where('email', $request->email)->first();
            $user->password = bcrypt($request->password);
            $user->save();
        
            // Hapus OTP setelah berhasil digunakan
            DB::table('password_resets')->where('email', $request->email)->delete();
        
            return response()->json(['message' => 'Password berhasil diatur ulang.']);
        }
}
