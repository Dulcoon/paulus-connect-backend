<?php

namespace App\Services;

use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\Facades\Http;

class FirebaseNotificationService
{
    protected $projectId;
    protected $credentialsPath;

    public function __construct()
    {
        $this->projectId = 'paulus-connect'; // Ganti sesuai project ID kamu
        $this->credentialsPath = storage_path('app/firebase/firebase_services.json');
    }

    protected function generateAccessToken()
    {
        $scope = 'https://www.googleapis.com/auth/firebase.messaging';

        $credentials = new ServiceAccountCredentials(
            $scope,
            $this->credentialsPath
        );

        $authToken = $credentials->fetchAuthToken();

        return $authToken['access_token'] ?? null;
    }

    public function sendNotification($deviceToken, $title, $body, $userId, $msType, $imageUrl = null)
    {
        $accessToken = $this->generateAccessToken();

        if (!$accessToken) {
            throw new \Exception("Failed to get access token.");
        }

        $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";

        $payload = [
            'message' => [
                'token' => $deviceToken,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                    'image' => $imageUrl
                ],
                'data' => [
                    'userId' => $userId,
                    'name' => $title,
                    'mstype' => $msType
                ]
            ]
        ];

        $response = Http::withToken($accessToken)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post($url, $payload);

        return $response->successful() ? 'Notification sent.' : $response->body();
    }
}
