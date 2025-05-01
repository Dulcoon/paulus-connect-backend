<?php

namespace App\Services;

use Twilio\Rest\Client;

class WhatsAppService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendMessage($to, $message)
    {
        try {
            $this->twilio->messages->create(
                "whatsapp:$to", // Nomor tujuan
                [
                    'from' => env('TWILIO_WHATSAPP_NUMBER'), // Nomor WhatsApp Twilio
                    'body' => $message, // Pesan yang dikirim
                ]
            );

            return true;
        } catch (\Exception $e) {
            return false; // Tangani error jika pengiriman gagal
        }
    }
}