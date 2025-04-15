<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Log;

class FCMController extends Controller
{
    public function saveToken(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'fcm_token' => 'required|string',
        ]);

        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response()->json(['message' => 'FCM token saved successfully']);
    }

    public function sendNotification(Request $request, FirebaseService $firebase)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);
    
        $user = Auth::user();
    
        if (!$user || !$user->fcm_token) {
            return response()->json(['message' => 'FCM token tidak ditemukan atau user tidak valid'], 404);
        }
    
        try {
            $report = $firebase->sendNotification(
                $user->fcm_token,
                $request->title,
                $request->body,
            );
    
            return response()->json([
                'message' => 'Notifikasi terkirim',
                'report' => $report,
                'fcm_token' => $user->fcm_token
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim notifikasi: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal mengirim notifikasi: ' . $e->getMessage()], 500);
        }
    }

    public function sendNotificationToUser(string $fcmToken, string $title, string $body, FirebaseService $firebase, array $data = [])
    {
        if (!$fcmToken) {
            Log::warning('FCM token tidak ditemukan.');
            return false; // Atau Anda bisa melempar exception jika diperlukan
        }

        try {
            // Tambahkan data tambahan ke notifikasi
            $report = $firebase->sendNotification($fcmToken, $title, $body, $data);

            Log::info('Notifikasi berhasil dikirim.', [
                'fcm_token' => $fcmToken,
                'title' => $title,
                'body' => $body,
                'data' => $data,
                'report' => $report,
            ]);

            return $report; // Mengembalikan laporan pengiriman
        } catch (\Exception $e) {
            Log::error('Gagal mengirim notifikasi: ' . $e->getMessage(), [
                'fcm_token' => $fcmToken,
                'title' => $title,
                'body' => $body,
                'data' => $data,
            ]);

            return false; // Atau Anda bisa melempar exception jika diperlukan
        }
    }
}