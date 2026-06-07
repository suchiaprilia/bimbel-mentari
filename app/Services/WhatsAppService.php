<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected string $token;
    protected string $url;

    public function __construct()
    {
        $this->token = config('services.fonnte.token') ?? '';
        $this->url = config('services.fonnte.url') ?? 'https://api.fonnte.com/send';
    }

    // ====================================================
    // [CORE-LOGIC] HTTP CLIENT UNTUK FONNTE API
    // Fungsi ini bertugas sebagai "kurir". Menerima teks pesan dan nomor HP,
    // membersihkan nomor HP dari karakter aneh, lalu melakukan metode POST
    // ke server API Fonnte dengan membawa Token dari file .env.
    // ====================================================
    public function sendMessage(string $phone, string $message): bool
    {
        // Bersihkan nomor HP dari spasi atau strip (misal: 0812-3456 -> 08123456)
        $normalizedPhone = preg_replace('/\D+/', '', $phone);

        if (empty($normalizedPhone)) {
            Log::warning('WhatsApp send failed: phone number is empty', [
                'phone' => $phone,
                'message' => $message,
            ]);

            return false;
        }

        if (empty($this->token)) {
            Log::error('WhatsApp send failed: Fonnte API token is not configured');
            return false;
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => $this->token,
            ]);

            // Nonaktifkan SSL verify di local (development only)
            if (app()->environment('local')) {
                $http = $http->withoutVerifying();
            }

            // Kirim paket data (Payload) ke API Fonnte
            $response = $http->post($this->url, [
                'target' => $normalizedPhone,
                'message' => $message,
                'countryCode' => '62', // Otomatis mengonversi 0812 menjadi 62812
            ]);

            if ($response->successful()) {
                Log::info('WhatsApp message sent successfully', [
                    'phone' => $normalizedPhone,
                    'response' => $response->json(),
                ]);
                return true;
            }

            Log::error('WhatsApp API error', [
                'phone' => $normalizedPhone,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('WhatsApp connection error', [
                'phone' => $normalizedPhone,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
