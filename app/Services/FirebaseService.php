<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Exception\Messaging\MessagingException;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Support\Facades\Log; // Import Log facade 

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials.service_account'));
        $this->messaging = $factory->createMessaging();
    }

    public function sendNotification(string $token, string $title, string $body, array $data = [], ?string $imageUrl = null)
    {
        try {
            $message = CloudMessage::new()
                ->withTarget('token', $token)
                ->withData(array_merge([
                    'title' => $title,
                    'body' => $body,
                    'image' => $imageUrl ?? '',
                ], $data)); // tanpa Notification
    
            $report = $this->messaging->send($message);
    
            Log::info('Notifikasi berhasil dikirim.', [
                'token' => $token,
                'title' => $title,
                'body' => $body,
                'data' => $data,
                'report' => $report,
            ]);
    
            return $report;
        } catch (\Exception $e) {
            Log::error('Notifikasi Gagal: ' . $e->getMessage());
            throw $e;
        }
    }
}